<?php

namespace AppBundle\Core;

use AppBundle\Core\CommandContext\BaseCommandContext;
use AppBundle\Core\Exception\DuplicateProductPerFileException;
use AppBundle\Core\Helper\CSVFormatMap;
use AppBundle\Core\ImportRule\ImportRuleFilter;
use AppBundle\Core\Product\Product;
use AppBundle\Core\Product\ProductCollection;
use AppBundle\Core\Report\Report;
use AppBundle\Entity\ProductDataEntity;
use AppBundle\Repository\ProductDataRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CSVExecutor processes .csv-file and, based on its data,
 * imports the products into the DB.
 * @package AppBundle\Core
 */
class CSVExecutor implements RunnableInterface
{
    const MSG_FILE_DOESNT_EXIST = 'The "%s" file does not exist.';
    const MSG_COMPLETED         = 'The import process is completed.';

    /**
     * @var $commandContext BaseCommandContext
     */
    private $commandContext;

    /**
     * @var $io SymfonyStyle
     */
    private $io;

    /**
     * @var $em EntityManagerInterface
     */
    private $em;

    /**
     * CSVExecutor constructor.
     *
     * @param InputInterface         $input
     * @param OutputInterface        $output
     * @param EntityManagerInterface $em
     */
    public function __construct(InputInterface $input, OutputInterface $output, EntityManagerInterface $em)
    {
        $this->commandContext = new BaseCommandContext($input);
        $this->io             = new SymfonyStyle($input, $output);
        $this->em             = $em;
    }

    /**
     * It is an example of a simple import logic.
     *
     * If the .csv-file will be contained a large number of rows (over 10k), then another solution may be
     * required to increase performance, for example: using Gearman Job Server or an another way.
     *
     * @return void
     */
    public function run()
    {
        if (!$this->commandContext->existsFile()) {
            $this->io->error(sprintf(self::MSG_FILE_DOESNT_EXIST, $this->commandContext->getFilePath()));
            return;
        }

        $productCollection = new ProductCollection();
        $importRuleFilter  = new ImportRuleFilter();
        $report            = new Report();

        $file = new \SplFileObject($this->commandContext->getFilePath());
        $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::DROP_NEW_LINE | \SplFileObject::SKIP_EMPTY);

        $rowNumber = 0;
        while (!$file->eof()) {
            $rowNumber++;
            $report->increaseProcessed();
            $rawProperties = $file->fgetcsv();

            /**
             * Skip row of .csv-file with incorrect format.
             */
            if (false === $rawProperties || CSVFormatMap::COLUMN_COUNT !== count($rawProperties)) {
                $report->addFailedRow($rowNumber);
                $report->increaseFailed();
                continue;
            }

            /**
             * Initialize Product object by data from the row of .csv-file.
             */
            $product = Product::build($rawProperties);

            /**
             * Check Product for validity and compliance with all import rules.
             */
            if (false === $product->isValid()) {
                $report->addFailedRow($rowNumber);
                $report->increaseFailed();
                continue;
            } elseif (false === $importRuleFilter->isProductAllowed($product)) {
                $report->increaseSkipped();
                continue;
            } else {
                try {
                    $productCollection->add($product);
                    $report->increaseSuccessful();
                } catch (DuplicateProductPerFileException $e) {
                    $report->increaseSkipped();
                }
            }
        }

        if (false === $this->commandContext->isTestMode() && $productCollection->count() > 0) {
            $this->importProcess($productCollection);
        }

        /**
         * Display the report.
         */
        $this->io->success(self::MSG_COMPLETED);
        $this->io->success($report->toStringMainInfo());
        if ($report->getFailedCount() > 0) {
            $this->io->caution($report->toStringFailedRows());
        }

        return;
    }

    /**
     * Imports (update or insert) the products data into DB.
     *
     * @param ProductCollection $productCollection
     *
     * @return void
     */
    private function importProcess(ProductCollection $productCollection)
    {
        /**
         * Find exist products and update them.
         */
        $productDataRepository    = $this->em->getRepository('AppBundle:ProductDataEntity');
        $existProductDataEntities = $productDataRepository->findBy([
            ProductDataRepository::FIELD_NAME_PRODUCT_CODE => $productCollection->getProductCodeList()
        ]);
        $existProductCodeList     = [];

        /**
         * @var $productDataEntity ProductDataEntity
         */
        foreach ($existProductDataEntities as $productDataEntity) {
            $productCode = $productDataEntity->getProductCode();
            $existProductCodeList[$productCode] = true;

            /**
             * @var $product Product
             */
            $product = $productCollection->offsetGet($productCode);

            $productDataEntity->setProductName($product->getName()->getValue())
                              ->setProductDesc($product->getDescription()->getValue())
                              ->setStock($product->getStock()->getValue())
                              ->setCost($product->getCost()->getValue());
            if (true === $product->getDiscontinued()->getValue()) {
                $productDataEntity->setDiscontinued(new \DateTime());
            }
            $this->em->persist($productDataEntity);
        }

        /**
         * Import new products.
         */
        foreach ($productCollection as $productCode => $product) {
            if (isset($existProductCodeList[$productCode])) {
                continue;
            }

            $newProductDataEntity = new ProductDataEntity();
            $newProductDataEntity->setProductCode($productCode)
                                 ->setProductName($product->getName()->getValue())
                                 ->setProductDesc($product->getDescription()->getValue())
                                 ->setStock($product->getStock()->getValue())
                                 ->setCost($product->getCost()->getValue())
                                 ->setAdded(new \DateTime());
            if (true === $product->getDiscontinued()->getValue()) {
                $newProductDataEntity->setDiscontinued(new \DateTime());
            }
            $this->em->persist($newProductDataEntity);
        }

        $this->em->flush();
        $this->em->clear();

        return;
    }
}
