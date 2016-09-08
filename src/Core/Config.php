<?php
/**
 * Singleton Configuration Class
 *
 * Class Config
 * @package GigaAI\Core
 */

namespace GigaAI\Core;

class Config
{
	private static $instance;

	public $config = array();

	public static function getInstance()
	{
		if (null === static::$instance)
			static::$instance = new static();

		return static::$instance;
	}

	private function __construct(){}

	private function __clone(){}

	private function __wakeup(){}

	/**
	 * Get config by key
	 *
	 * @param $key
	 * @param null $default
	 * @return mixed|null
	 */
	public function get($key, $default = null)
	{
		if ( ! empty($this->config[$key]))
			return $this->config[$key];

		return $default;
	}

	public function toArray()
	{
		return $this->config;
	}

	/**
	 * Set config
	 *
	 * @param mixed $key
	 * @param null $value
	 * @return $this
	 */
	public function set($key, $value = null)
	{
		if (is_array($key) && null === $value)
		{
			foreach ($key as $k => $v)
			{
				$this->config[$k] = $v;
			}

			return $this;
		}

		$this->config[$key] = $value;

		return $this;
	}

	/**
	 * Load configuration from file. The file should returns an array of settings.
	 *
	 * @param String $path File path
	 *
	 * @return $this|void
	 */
	public function loadFromFile($path)
	{
		if ( ! is_file($path))
			return;

		$config = require_once $path;

		if (is_array($config))
			$this->config = $config;
	}

	public static function fromFile($configFilePath)
	{
		$configArray = file_get_contents($configFilePath);
        if (!is_array($configArray)) {
            throw new \Exception(sprintf(
                'File \'%s\' must be valid JSON',
                $configFilePath
            ));
        }
		return new static($configFilePath);
	}

	public function __call($name, $args = array())
	{
		return call_user_func_array(array($this, $name), $args);
	}

	public static function __callStatic($name, $args = array())
	{
		return self::getInstance()->__call($name, $args);
	}
}