<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('determine_niveau')){

	function determine_niveau($experience)
	{
	
		$result['niveau'] = 1;
		$result['needed_xp'] = LEVELS[0];

		$cpt = 0;
		while($experience >= LEVELS[$cpt] && $cpt+1 < count(LEVELS))
		{	
			$experience -= LEVELS[$cpt];
			$cpt++;
			$result['niveau'] = $cpt+1;
		}

		$result['needed_xp'] = LEVELS[$cpt];
		$result['xp_remaining'] = $experience;
		$result['pourcentage'] = ($experience/($result['needed_xp']))*100;

		return $result;
	}
}