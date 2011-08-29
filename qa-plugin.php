<?php

/*
	Question2Answer 1.4.1 (c) 2011, Gideon Greenspan

	http://www.question2answer.org/


	File: qa-plugin/tag-cloud-widget/qa-tag-cloud.php
	Version: 1.4.1
	Date: 2011-07-10 06:58:57 GMT
	Description: Widget module class for tag cloud plugin


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

/*
	Plugin Name: Related questions widget
	Plugin URI:
	Plugin Description: Outputs a list of related questions at the sidebar
	Plugin Version: 1.0
	Plugin Date: 2011-08-29
	Plugin Author: ercalote
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