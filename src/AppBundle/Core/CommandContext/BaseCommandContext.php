<?php

namespace AppBundle\Core\CommandContext;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;
use AppBundle\Core\CommandContext\Definer\ModeDefiner;
use AppBundle\Core\CommandContext\Definer\FilePathDefiner;

/**
 * Class BaseCommandContext helps to encapsulate command line context
 * and to use it flexible.
 * @package AppBundle\Core\CommandContext
 */
class BaseCommandContext
{
    /**
     * @var $input InputInterface
     */
    protected $input;

    /**
     * @var $mode string
     */
    protected $mode;

    /**
     * @var $filePath string
     */
    protected $filePath;

    /**
     * BaseCommandContext constructor.
     *
     * @param InputInterface $input
     */
    public function __construct(InputInterface $input)
    {
        $this->input = $input;
        $this->init();
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     *
     * @return void
     */
    public function setMode($mode)
    {
        $this->mode = strtolower($mode);
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     *
     * @return void
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return bool
     */
    public function isTestMode()
    {
        return $this->getMode() === ModeDefiner::MODE_TEST;
    }

    /**
     * @return bool
     */
    public function existsFile()
    {
        return (new Filesystem())->exists($this->getFilePath());
    }

    /**
     * @return void
     */
    protected function init()
    {
        $this->initMode();
        $this->initFilePath();

        return;
    }

    /**
     * @return void
     */
    protected function initMode()
    {
        $modeDefiner = new ModeDefiner($this->input);
        $this->setMode($modeDefiner->defineValue());

        return;
    }

    /**
     * @return void
     */
    protected function initFilePath()
    {
        $filePathDefiner = new FilePathDefiner($this->input);
        $this->setFilePath($filePathDefiner->defineValue());

        return;
    }
}
