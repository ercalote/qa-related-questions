<?php

	class qa_related_questions {

		function option_default($option)
		{
			if ($option=='related_qs_num')
				return 10;
		}


		function admin_form()
		{
			$saved=false;

			if (qa_clicked('related_qs_save_button')) {
				qa_opt('related_qs_num', (int)qa_post_text('related_qs_num_field'));
				$saved=true;
			}

			return array(
				'ok' => $saved ? 'Related questions settings saved' : null,

				'fields' => array(
					array(
						'label' => 'Number of questions to show (max):',
						'type' => 'number',
						'value' => (int)qa_opt('related_qs_num'),
						'tags' => 'NAME="related_qs_num_field"',
					),
				),

				'buttons' => array(
					array(
						'label' => 'Save Changes',
						'tags' => 'NAME="related_qs_save_button"',
					),
				),
			);
		}

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

				$upper = (qa_opt('related_qs_num') < count($relatedquestions)) ? qa_opt('related_qs_num') : count($relatedquestions);
				foreach($relatedquestions as $related)
				{					if($upper<=0) break;
					$themeobject->output('<p style="margin:0 0 10px 0; font-weight:bold;"><a href="'.qa_path_html(qa_q_request($related['postid'], $related['title'])).'">'.$related['title'].'</a></p>');
					$upper--;
				}
			}
		}

	};


/*
	Omit PHP closing tag to help avoid accidental output
*/