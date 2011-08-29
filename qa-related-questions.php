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

	class qa_related_questions {

		function allow_template($template)
		{
			$allow=false;

			switch ($template)
			{
				case 'question':
					$allow=true;
					break;
			}

			return $allow;
		}

		function allow_region($region)
		{
			return ($region=='side');
		}

		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
			require_once QA_INCLUDE_DIR.'qa-db-selects.php';

			global $qa_login_userid, $questionid, $relatedcount, $question, $relatedquestions, $qa_cookieid, $usershtml;

            list($question, $relatedquestions)=qa_db_select_with_pending(
				qa_db_full_post_selectspec($qa_login_userid, $questionid),
				qa_db_related_qs_selectspec($qa_login_userid, $questionid)
			);

			if (($relatedcount>1) && !$question['hidden']) {
				$minscore=qa_match_to_min_score(qa_opt('match_related_qs'));

				foreach ($relatedquestions as $key => $related)
					if ( ($related['postid']==$questionid) || ($related['score']<$minscore) )
						unset($relatedquestions[$key]);

				if (count($relatedquestions))
					$themeobject->output('<h2>'.qa_lang('main/related_qs_title').'</h2>');
				else
					$themeobject->output('<h2>'.qa_lang('main/no_related_qs_title').'</h2>');

				foreach ($relatedquestions as $related)
					$themeobject->output('<p style="margin:0 0 10px 0; font-weight:bold;"><a href="'.qa_path_html(qa_q_request($related['postid'], $related['title'])).'">'.$related['title'].'</a></p>');
			}
		}

	};


/*
	Omit PHP closing tag to help avoid accidental output
*/