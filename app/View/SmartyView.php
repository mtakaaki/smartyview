<?php
App::import('Vendor', 'Smarty', array('file' => 'Smarty' . DS . 'Smarty.class.php'));

/**
 * Original :
 *	CakePHP 2.0 + Smarty
 *	http://www18.atwiki.jp/javascripter/pages/26.html 2011/10/20
 *
 * Customized :
 *	CakePHP 2.4.6 + Smarty 3.1.17
 */
class SmartyView extends View {
	private $Smarty;

	public function __construct(Controller $controller = null) {
		parent::__construct($controller);

		$this->Smarty = new Smarty();

		$this->subDir = '';

		$this->ext = '.tpl';
		$pluginsDir = $this->Smarty->plugins_dir;
		$pluginsDir[] = APP . 'Vendor' . DS . 'smarty' . DS . 'plugins' . DS;
		$this->Smarty->plugins_dir = $pluginsDir;
		$this->Smarty->compile_dir = TMP . 'smarty' . DS . 'compile' . DS;
		$this->Smarty->cache_dir = TMP . 'smarty' . DS . 'cache' . DS;
		$this->Smarty->error_reporting = 'E_ALL';
		$this->Smarty->debugging = false;
		$this->Smarty->compile_check = true;

		// Assign HelperObjects to smarty variables
		$helpers = HelperCollection::normalizeObjectArray($this->helpers);
		foreach ($helpers as $name => $properties) {
			list(, $class) = pluginSplit($properties['class']);
			$this->Smarty->assign($name, $this->{$class});
		}

		// Assign self View object
		$this->Smarty->assign('this', $this);
		$this->Smarty->assign('View', $this);
	}

	protected function _render($viewFile, $data = array()) {
		if (substr($viewFile, -4, 4) == '.ctp') {
			return parent::_render($viewFile, $data);
		}
		$trace = debug_backtrace();
		$caller = array_shift($trace);
		if ($caller === "element") parent::_render($viewFile, $data);

		if (empty($data)) {
			$data = $this->viewVars;
		}

		foreach ($data as $data => $value) {
			if (!is_object($data)) {
				$this->Smarty->assign($data, $value);
			}
		}

		ob_start();
		$this->Smarty->display($viewFile);
		return ob_get_clean();
	}
}
