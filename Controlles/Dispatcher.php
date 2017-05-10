protected function dispatch($params)
	{
		$config = Registry::fetch('config');
		$controllerName = $this->namespace . $params['controller'];
		$controllerObject = new $controllerName($params['action'], isset($params['params']) ? $params['params'] : false);
		
		Registry::fetch('session')->saveSession();
	}
	
	/* URL Builder
	 * controller, action, parameters syntax:
	 * url:
	 * abc - any string for matching
	 * :abc - param name
	 * * - wildcard (ignore field)
	 * @return array url list
	 * @todo put this method as abstract - each site need to
	 * have it's own implementation
	 *
	 * <pre>protected function urlBuilder()
	 *  {
	 *			return array('vijesti' => array(
	 *																array('url' => 'arhiva/kategorija/:categoryId/*',
	 *																		 'controller' => 'news',
	 *																		 'action' => 'view'),
	 *															array('url' => 'kategorija/:categoryId/*', 'module' => 'news', 'controller' => 'category', 'action' => 'view'),
	 *															 array('url' => 'stranica/:controller',
	 *																			 'controller' => 'news',
	 *																			 'action' => 'view'),
	 *																 array('url' => 'uredi/:controllerId',
	 *																			 'controller' => 'news',
	 *																			 'action' => 'edit'),
	 *																 array('url' => 'uredi',
	 *																			 'controller' => 'news',
	 *																			 'action' => 'read'),
	 *																 array('url' => 'tguz/:someId',
	 *																			 'controller' => 'news',
	 *																			 'action' => 'edit'),
	 *	 						 									 array('url' => '',
	 *																			 'controller' => 'news',
	 *																			 'action' => 'view')),
	 *									'oglas' => array(
	 *															array('url' => '', 'controller' => 'classifieds', 'action' => 'view'),
	 *															array('url' => 'kategorija/:categoryId/* /:controller/:sort', 'controller' => 'classifieds', 'action' => 'view'))
	 *							);
	 *  }</pre> 
 	 */
	
	protected function urlBuilder()
	{
		return Registry::fetch('config')->urlBuilder();
	}
	
	/**
	 * Set's the missing rewrite $_GET variables into $_REQUEST
	 */
	/*protected function fetchGetMethod()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$pos = strpos($uri, '?');
		if($pos !== false)
		{
			$uri = substr($uri, ($pos+1));
			$getAll = explode("&", $uri);
			foreach($getAll as $key => $singleGet)
			{
				list($variable, $value) = explode("=", $singleGet);
				if($variable && $value)
				{
					$_REQUEST[$variable] = $value;
					$_GET[$variable] = $value;
				}
			}
		}
	}*/
	

}
?>
Sign up for free to join this conversation on GitHub. Already have an account? Sign in to comment
Contact GitHub API Training Shop Blog About
© 2017 GitHub, Inc. Terms Privacy Security Status Help