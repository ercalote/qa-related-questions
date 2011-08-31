<?php

/*
        Plugin Name: Related Questions Widget
        Plugin URI:
        Plugin Description: Outputs a list of related questions
        Plugin Version: 1.1
        Plugin Date: 2011-08-31
        Plugin Author: ercalote
        Plugin Author URI:
        Plugin License: GPLv2
        Plugin Minimum Question2Answer Version: 1.4
*/

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}


	qa_register_plugin_module('widget', 'qa-related-questions.php', 'qa_related_questions', 'Related questions');


/*
	Omit PHP closing tag to help avoid accidental output
*/