<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
	private $CI;
	private $var = array();
	private $theme = 'default';
	
/*
|===============================================================================
| Constructeur
|===============================================================================
*/
	
	public function __construct()
	{
		//get_instance permet d'avoir accès aux fonctions codeigniter
		$this->CI = get_instance();
		//$this->var['suivi_google'] =  $this->CI->config->item('suivi_google');
		$this->var['title'] = ucfirst($this->CI->router->fetch_method()) . ' - ' . ucfirst($this->CI->router->fetch_class());
		$this->var['output'] = '';
		$this->var['meta'] = array();
		$this->var['css'] = array();
		$this->var['js'] = array();
	}
	
/*
|===============================================================================
| Méthodes pour charger les vues
|	. view --> à appeler en dernier
|	. views --> si plusieurs vues à loader
|===============================================================================
*/
	
	public function view($name, $data = array())
	{
		$this->var['output'] .= $this->CI->load->view($name, $data, true);		
		$this->CI->load->view('../themes/' . $this->theme, $this->var);
	}
	
	public function views($name, $data = array())
	{
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
		return $this;
	}

	public function set_title($title)
	{
		if(is_string($title) AND !empty($title))
		{
			$this->var['title'] = $title;
			return true;
		}
		return false;
	}

	public function add_meta($type=null, $name, $content)
	{
		if(is_string($type) AND !empty($type) AND is_string($name) AND !empty($name) AND is_string($content) AND !empty($content))
		{						
			$this->var['meta']['type'][] = $type;
			$this->var['meta']['name'][] = $name;
			$this->var['meta']['content'][] = $content;
			return true;
		}
	}

	public function add_css($nom)
	{
		if(is_string($nom) AND !empty($nom) AND file_exists('./' . $this->CI->config->item('css_path') . $nom . '.css'))
		{
			$this->var['css'][] = css($nom . '.css');
			return true;
		}
		return false;
	}

	public function add_js($nom)
	{
		if(is_string($nom) AND !empty($nom) AND file_exists('./' . $this->CI->config->item('js_path') . $nom . '.js'))
		{
			$this->var['js'][] = js($nom . '.js');
			return true;
		}
		return false;
	}

	public function set_theme($theme)
	{
		if(is_string($theme) AND !empty($theme) AND file_exists('./application/themes/' . $theme . '.php'))
		{
			$this->theme = $theme;
			return true;
		}
		return false;
	}

	public function add_bootstrap_responsive()
	{
		$this->add_css('bootstrap');
		$this->add_css('bootstrap-responsive');
		$this->add_js('bootstrap');
	}

	public function add_js_grocery($path)
	{
		$this->var['js'][] = js_grocery($path);
		return true;
	}

	public function add_css_grocery($path)
	{
		$this->var['css'][] = css_grocery($path);
		return true;
	}
}