<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// require_once BASEPATH."tcpdf/examples/tcpdf_include.php";

// echo  BASEPATH."tcpdf/examples/tcpdf_include.php";die;
class CvPDF extends MY_Controller
{
	// 
	function __construct()
	{
		parent::__construct();
		$this->load->model('api/master_model',     '', TRUE);
		$this->load->helper("phpmailerautoload");
	}

	function index($UserID = NULL)
	{
		$response = array();
		$response['data'] = $response['Qualification'] = $response['Project'] = $response['Language'] = $response['Certificate'] = $response['Employement'] = $response['Skill'] = array();
		if ($UserID != '') {
			ob_start();
			// require_once('C:/wamp64/www/SMBStayCheck_Admin/trunk/system/tcpdf/tcpdf.php');
			require_once BASEPATH . "tcpdf/tcpdf.php";
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Kunden Dadheech');
			$pdf->SetTitle('Candidate Detail');
			$pdf->SetSubject('Unique-HR');
			$pdf->SetKeywords('TCPDF, PDF');

			// set default header data
			// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'TCPDF HTML', PDF_HEADER_STRING);
			// $pdf->SetHeaderData('../../../../assets/admin/img/logo.png', PDF_HEADER_LOGO_WIDTH, 'Candidate Detail', 'Date : '.date('d-m-Y'));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(BASEPATH . 'tcpdf/examples/lang/eng.php')) {
				require_once(BASEPATH . 'tcpdf/examples/lang/eng.php');
				if (!isset($l) || empty($l)) {
					$l = array();
					$l['a_meta_charset'] = 'UTF-8';
					$l['a_meta_dir'] = 'ltr';
					$l['a_meta_language'] = 'en';
					$l['w_page'] = 'page';
				}
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 9);

			// add a page
			$pdf->AddPage();

			$_result['Profile'] = $this->master_model->getQueryResult("call usp_M_GetProfileByID('" . $UserID . "','" . base_url() . "')");
			if (isset($_result['Profile']) && !empty($_result['Profile']) && !isset($_result['Profile']['0']->Message)) {
				$response['Error'] = 200;
				$response['Message'] = 'Get CV data successfully.';
				$_result['Profile'][0]->CVDate = '';
				$mno_list = explode('-', $_result['Profile'][0]->MobileNo);
				$_result['Profile'][0]->CountryCode = '';
				if (count($mno_list) >= 2) {
					$_result['Profile'][0]->CountryCode = $mno_list[0];
					$_result['Profile'][0]->MobileNo = $mno_list[1];
				}

				if (isset($_result['Profile'][0]->CVPath) && $_result['Profile'][0]->CVPath != '' && file_exists(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name)) {
					//$_result[0]->CVDate = date ("F d Y H:i:s.", filemtime($_result[0]->CVPath));
					$lastModified = @filemtime(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name);
					if ($lastModified == NULL)
						$lastModified = filemtime(utf8_decode(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name));
					$_result['Profile'][0]->CVDate = date("d M Y", $lastModified);
				}
				$response['data'] = $_result['Profile'][0];
				// print_r($response['data']); 

				$response['Qualification'] = $this->master_model->getQueryResult("call usp_M_GetUserQualificationByUserID('" . $UserID . "')");
				if (empty($response['Qualification']) || isset($response['Qualification']['0']->Message)) {
					$response['Qualification'] = array();
				}
				$response['Project'] = $this->master_model->getQueryResult("call usp_M_GetUserProjectByUserID('" . $UserID . "')");
				if (empty($response['Project']) || isset($response['Project']['0']->Message)) {
					$response['Project'] = array();
				}
				$response['Language'] = $this->master_model->getQueryResult("call usp_M_GetUserLanguageByUserID('" . $UserID . "')");
				if (empty($response['Language']) || isset($response['Language']['0']->Message)) {
					$response['Language'] = array();
				}
				$response['Certificate'] = $this->master_model->getQueryResult("call usp_M_GetUserCertificateByUserID('" . $UserID . "')");
				if (empty($response['Certificate']) || isset($response['Certificate']['0']->Message)) {
					$response['Certificate'] = array();
				}
				$response['Employement'] = $this->master_model->getQueryResult("call usp_M_GetUserEmployementByUserID('" . $UserID . "')");
				if (empty($response['Employement']) || isset($response['Employement']['0']->Message)) {
					$response['Employement'] = array();
				}

				$response['Skill'] = $this->master_model->getQueryResult("call usp_M_GetUserSkillByUserID('" . $UserID . "')");
				if (empty($response['Skill']) || isset($response['Skill']['0']->Message)) {
					$response['Skill'] = array();
				}
				$response['ProfileStep'] = $this->master_model->getInlineQuery("SELECT Fn_M_GetCandidateProfileStepPer('" . $UserID . "') as Action");
				if (empty($response['ProfileStep']['0']) || isset($response['ProfileStep']['0']->Message)) {
					$response['ProfileStep'] = array();
				} else {
					$list = explode('~', $response['ProfileStep']['0']->Action);
					if (!empty($list)) {
						$response['ProfileStep'] = array('Percentage' => @$list[0], 'RemainingAction' => @$list[1]);
					} else {
						$response['ProfileStep'] = array();
					}
				}
			} else if (isset($_result['Profile']['0']->Message) && $_result['Profile']['0']->Message != "") {
				$msg = explode('~', $_result['Profile']['0']->Message);
				$response['Error'] = ($msg[0]) ? $msg[0] : '103';
				$response['Message'] = $msg[1];
				$response['data'] = array();
			} else {
				$response['Error'] = 104;
				$response['Message'] = 'Error has been occurred please try again later.';
			}
			// return array('getCVData'=>$response);


			if ($response['Error'] == '200') {
				// create some HTML content
				//<img src="assets/admin/img/logo.png" width="100px" height="100px"><hr/>
				$html = '<table><tr><td>
							<table style="text-align:center;padding:0px">
								<tr><td style="font-size: 20px;padding: 10px 0 0;font-family: arial;"><strong>' . strtoupper(@$response['data']->FirstName . ' ' . @$response['data']->LastName) . '</strong></td></tr>
								<tr><td style="font-size: 12px;padding: 10px 0 0;font-family: arial;">' . @$response['data']->StatusText . '</td></tr>
								<tr><td style="font-size: 12px;padding: 10px 0 0;font-family: arial;" colspan="2"><strong>' . @$response['data']->MobileNo . '</strong> | <strong> ' . @$response['data']->EmailID . ' </strong> | <strong> ' . @$response['data']->CityName . ' </strong></td></tr>
							</table></td></tr>
							</table><br/>';
				if (!empty($response['data']->ProfileSummary)) {
					$html .= '<div style="">
								<table style="padding:3px 3px 3px 0px;">
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform: uppercase;">SUMMARY</td>
									</tr>
									<tr>
										<td style="font-size: 13px;font-family: arial; text-align: justify;" colspan="25">' . @$response['data']->ProfileSummary . '</td>
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Skill']) && !isset($response['Skill']['0']->Message)) {
					$html .= '<div>	
								<table style="padding:3px 3px 3px 0px;">
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold">KEY SKILLS</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="padding:5px 3px 3px 0px;">
											<tr>';
					$mod_count = 1;
					foreach ($response['Skill'] as $item) {
						$html .= '<td colspan="2" style="font-size:13px;line-height:12px"><ul style="padding:0px">
															<li >' . @$item->Name . '</li>
															</ul></td>';

						if ($mod_count % 2 == 0) {
							$html .= '</tr><tr>';
						}
						$mod_count++;
					}
					$html .= '<td></td><td></td>
												</tr></table>
										</td>	
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Project']) && !isset($response['Project']['0']->Message)) {
					$html .= '<div>	
									<table>
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">KEY PROJECTS</td>
									</tr>';
					$html .=	'<tr>										
										<td colspan="2">
											<table style="padding:3px 3px 3px 0px;font-size:13px;">';
					foreach ($response['Project'] as $item) {

						$html .= '<tr><td style="font-weight:bold">' . @$item->ProjectTitle . '</td></tr>
											<tr><td><ul><li>' . @$item->ProjectDescription . '</li></ul></td></tr><br>';
					}
					$html .=			'</table>
										</td>
									</tr>';

					$html .= '</table></div>';
				}
				if (!empty($response['Employement']) && !isset($response['Employement']['0']->Message)) {
					// print_r($response['Employement']);
					$html .= '<div>	
									<table style="padding:3px 3px 0px 0px;">
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">EXPERIENCE</td>
									</tr>
									<tr>										
										<td colspan="2">
											<table style="padding:3px 3px 3px 0px;font-size:13px;">';
					foreach ($response['Employement'] as $item) {
						$startDate = explode('/', $item->StartDate);
						$start_Date = date($startDate[2] . '-' . $startDate[1] . '-' . $startDate[0]);
						if ($item->EndDate != '') {
							$endDate = explode('/', $item->EndDate);
							$end_Date = date($endDate[2] . '-' . $endDate[1] . '-' . $endDate[0]);
						} else {
							$endDate = "Present";
						}
						$html .= '<tr>
													<td style="padding:10px 0px 0px 0px;">
														<span style="font-weight:bold;float:left;">' . @$item->Designation . '</span><br/>
														<span style="float:left;">' . @$item->OrganizationOther . '</span>
													</td>
													<td style="text-align:right;padding:0px 0px 0px 0px;">
														<span style="font-weight:bold;float:right;">' . date('F Y', strtotime(@$start_Date)) . ' - ' . ((@$end_Date) ? date('F Y', strtotime(@$end_Date)) : $endDate) . '</span><br/>
														<span style="float:right;">' . @$item->Location . '</span>
													</td>
												</tr>
												<tr>
													<td style="float:left;">' . @$item->Responsibilities . '
													</td>
												</tr>';
					}

					$html .= '</table>
										</td>
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Qualification']) && !isset($response['Qualification']['0']->Message)) {
					$html .= '<div>	
									<table style="padding:0px 3px 3x 0px">
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">EDUCATION</td>
									</tr>
									<tr>										
										<td colspan="2">
											<table style="padding:3px 3px 3x 0px;font-size:13px;">';
					foreach ($response['Qualification'] as $item) {
						if ($item->Grade == 'Other – Please State') {
							$grade = $item->OtherGrade;
						} else {
							$grade = $item->Grade;
						}
						$html .= '<tr>
													<td style="padding:10px 0px 0px 0px;">
														<span style="font-weight:bold;float:left;">' . @$item->University . '</span><br/>
														<span style="float:left;">' . @$item->Qualification . '</span><br/>
														<span style="font-weight:bold;float:left;">Grade: ' . @$grade . '</span>
													</td>
													<td style="text-align:right;padding:10px 0px 30px 0px;">
														<span style="float:right;">' . @$item->YearOfPassing . '</span>
														<span></span>
													</td>
												</tr><br>';
					}
					$html .= '</table></td></tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Certificate']) && !isset($response['Certificate']['0']->Message)) {
					$html .= '<div>	
								<table>
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">QUALIFICATIONS / CERTIFICATIONS</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="padding:3px 3px 3px 0px;font-size:13px;">
											<tr>
													<td style="font-family: arial;">';
					foreach ($response['Certificate'] as $item) {

						$html .= '<span style="display:inline-block; float:left; width=50% !important;">&#8226;    ' . @$item->Description . ((@$item->CertificateYear) ? ' (' . @$item->CertificateYear . ')' : '') . '</span><br>';
					}
					$html .= '</td>
												</tr></table>
										</td>	
									</tr>';
					$html .= '</table></div>';
				}
				$html .= '<div><span style="font-weight:bold;font-size:12px;">References Available Upon Request</span></div>';
				// output the HTML content
				$pdf->writeHTML($html, true, 0, true, 0);

				// echo $html;
				// exit;


				// reset pointer to the last page
				$pdf->lastPage();

				//Close and output PDF document
				$pdf->Output('cv.pdf', 'I');
				//          $file_name= time() . "_" . $UserID.'.pdf'; 
				// $pdf->Output(BASEPATH.'.'.CV_UPLOAD_PATH.$file_name,'F'); 
				// return $_result = $this->master_model->getQueryResult("call usp_M_UpdateDeleteCV('".$UserID."','".$file_name."','0','cv.pdf')");

			} else {
				echo 'User info not found.';
			}
		} else {
			echo 'User not found.';
		}
	}


	function cv_two($UserID = NULL)
	{
		$response = array();
		$response['data'] = $response['Qualification'] = $response['Project'] = $response['Language'] = $response['Certificate'] = $response['Employement'] = $response['Skill'] = array();
		if ($UserID != '') {
			ob_start();
			// require_once('C:/wamp64/www/SMBStayCheck_Admin/trunk/system/tcpdf/tcpdf.php');
			require_once BASEPATH . "tcpdf/tcpdf.php";
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Kunden Dadheech');
			$pdf->SetTitle('Candidate Detail');
			$pdf->SetSubject('Unique-HR');
			$pdf->SetKeywords('TCPDF, PDF');

			// set default header data
			// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'TCPDF HTML', PDF_HEADER_STRING);
			// $pdf->SetHeaderData('../../../../assets/admin/img/logo.png', PDF_HEADER_LOGO_WIDTH, 'Candidate Detail', 'Date : '.date('d-m-Y'));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(BASEPATH . 'tcpdf/examples/lang/eng.php')) {
				require_once(BASEPATH . 'tcpdf/examples/lang/eng.php');
				if (!isset($l) || empty($l)) {
					$l = array();
					$l['a_meta_charset'] = 'UTF-8';
					$l['a_meta_dir'] = 'ltr';
					$l['a_meta_language'] = 'en';
					$l['w_page'] = 'page';
				}
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 9);

			// add a page
			$pdf->AddPage();

			$_result['Profile'] = $this->master_model->getQueryResult("call usp_M_GetProfileByID('" . $UserID . "','" . base_url() . "')");
			if (isset($_result['Profile']) && !empty($_result['Profile']) && !isset($_result['Profile']['0']->Message)) {
				$response['Error'] = 200;
				$response['Message'] = 'Get CV data successfully.';
				$_result['Profile'][0]->CVDate = '';
				$mno_list = explode('-', $_result['Profile'][0]->MobileNo);
				$_result['Profile'][0]->CountryCode = '';
				if (count($mno_list) >= 2) {
					$_result['Profile'][0]->CountryCode = $mno_list[0];
					$_result['Profile'][0]->MobileNo = $mno_list[1];
				}

				if (isset($_result['Profile'][0]->CVPath) && $_result['Profile'][0]->CVPath != '' && file_exists(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name)) {
					//$_result[0]->CVDate = date ("F d Y H:i:s.", filemtime($_result[0]->CVPath));
					$lastModified = @filemtime(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name);
					if ($lastModified == NULL)
						$lastModified = filemtime(utf8_decode(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name));
					$_result['Profile'][0]->CVDate = date("d M Y", $lastModified);
				}
				$response['data'] = $_result['Profile'][0];
				// print_r($response['data']); 

				$response['Qualification'] = $this->master_model->getQueryResult("call usp_M_GetUserQualificationByUserID('" . $UserID . "')");
				if (empty($response['Qualification']) || isset($response['Qualification']['0']->Message)) {
					$response['Qualification'] = array();
				}
				$response['Project'] = $this->master_model->getQueryResult("call usp_M_GetUserProjectByUserID('" . $UserID . "')");
				if (empty($response['Project']) || isset($response['Project']['0']->Message)) {
					$response['Project'] = array();
				}
				$response['Language'] = $this->master_model->getQueryResult("call usp_M_GetUserLanguageByUserID('" . $UserID . "')");
				if (empty($response['Language']) || isset($response['Language']['0']->Message)) {
					$response['Language'] = array();
				}
				$response['Certificate'] = $this->master_model->getQueryResult("call usp_M_GetUserCertificateByUserID('" . $UserID . "')");
				if (empty($response['Certificate']) || isset($response['Certificate']['0']->Message)) {
					$response['Certificate'] = array();
				}
				$response['Employement'] = $this->master_model->getQueryResult("call usp_M_GetUserEmployementByUserID('" . $UserID . "')");
				if (empty($response['Employement']) || isset($response['Employement']['0']->Message)) {
					$response['Employement'] = array();
				}

				$response['Skill'] = $this->master_model->getQueryResult("call usp_M_GetUserSkillByUserID('" . $UserID . "')");
				if (empty($response['Skill']) || isset($response['Skill']['0']->Message)) {
					$response['Skill'] = array();
				}
				$response['ProfileStep'] = $this->master_model->getInlineQuery("SELECT Fn_M_GetCandidateProfileStepPer('" . $UserID . "') as Action");
				if (empty($response['ProfileStep']['0']) || isset($response['ProfileStep']['0']->Message)) {
					$response['ProfileStep'] = array();
				} else {
					$list = explode('~', $response['ProfileStep']['0']->Action);
					if (!empty($list)) {
						$response['ProfileStep'] = array('Percentage' => @$list[0], 'RemainingAction' => @$list[1]);
					} else {
						$response['ProfileStep'] = array();
					}
				}
			} else if (isset($_result['Profile']['0']->Message) && $_result['Profile']['0']->Message != "") {
				$msg = explode('~', $_result['Profile']['0']->Message);
				$response['Error'] = ($msg[0]) ? $msg[0] : '103';
				$response['Message'] = $msg[1];
				$response['data'] = array();
			} else {
				$response['Error'] = 104;
				$response['Message'] = 'Error has been occurred please try again later.';
			}
			// return array('getCVData'=>$response);


			if ($response['Error'] == '200') {
				// create some HTML content
				//<img src="assets/admin/img/logo.png" width="100px" height="100px"><hr/>
				// print_r($response['data']);
				$html = '<table><tr>
									<td style="font-size:30px;padding:10px 0 0;font-family: arial;text-align:left;"><strong>' . strtoupper(@$response['data']->FirstName . ' ' . @$response['data']->LastName) . '</strong>
									</td>
								</tr>
								<tr>
									<td colspan="2">	
										<table style="padding:3px 0px 3px 0px;">
											<tr>
												<td style="padding:10px 0px 0px 0px;">
													<span style="font-size:12px;padding:10px 0 0;float:left;">' . @$response['data']->StatusText . '</span>
												</td>
											</tr>
											<tr>
												<td style="text-align:right;padding:10px 0px 10px 0px;border-bottom: 3px solid #000;" colspan="4">
													<span style="float:right;">M: ' . @$response['data']->MobileNo . ' E: ' . @$response['data']->EmailID . ' L: ' . @$response['data']->CityName . '</span>
												</td>
											</tr>
										</table></td></tr>
							</table><br/><br/>';
				if (!empty($response['data']->ProfileSummary)) {
					$html .= '<div style="">
								<table style="padding:3px 3px 3px 0px;">
									<tr>
										<td style="font-size: 12px;font-family: arial; text-align: justify;" colspan="25">' . @$response['data']->ProfileSummary . '</td>
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Skill']) && !isset($response['Skill']['0']->Message)) {
					$html .= '<div>	
								<table>
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold">KEY SKILLS</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Skill'] as $item) {

						$html .= '<tr>
															<td>- ' . @$item->Name . '</td>
														  </tr>';
					}
					$html .= '</table>
										</td>	
									</tr>';
					$html .= '</table></div>';
				}

				if (!empty($response['Project']) && !isset($response['Project']['0']->Message)) {
					$html .= '<div>	
									<table>
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">KEY PROJECTS</td>
									</tr>';
					$html .=	'<tr>										
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Project'] as $item) {

						$html .= '<tr><td style="font-weight:bold;background-color:#e6e6e6;border-spacing: 0px;">  ' . @$item->ProjectTitle . '</td></tr>
											<tr><td>- ' . @$item->ProjectDescription . '</td></tr><br>';
					}
					$html .=			'</table>
										</td>
									</tr>';

					$html .= '</table></div>';
				}
				if (!empty($response['Employement']) && !isset($response['Employement']['0']->Message)) {
					// print_r($response['Employement']);
					$html .= '<div>	
									<table style="padding:3px 0px 3px 0px;">
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">EXPERIENCE</td>
									</tr>
									<tr>										
										<td colspan="2">
											<table style="padding:3px 0px 0px 0px;">';
					foreach ($response['Employement'] as $item) {
						$startDate = explode('/', $item->StartDate);
						$start_Date = date($startDate[2] . '-' . $startDate[1] . '-' . $startDate[0]);
						if ($item->EndDate != '') {
							$endDate = explode('/', $item->EndDate);
							$end_Date = date($endDate[2] . '-' . $endDate[1] . '-' . $endDate[0]);
						} else {
							$endDate = "Present";
						}
						$html .= '<tr>
													<td style="background-color:#e6e6e6;border-spacing: 0px;">
														<span style="font-weight:bold;float:left;">  ' . @$item->Designation . '</span>
													</td>
													<td style="text-align:right;background-color:#e6e6e6;border-spacing: 0px;">
														<span style="font-weight:bold;float:right;">' . date('F Y', strtotime(@$start_Date)) . ' - ' . ((@$end_Date) ? date('F Y', strtotime(@$end_Date)) : $endDate) . '</span>
													</td>
												</tr>
												<tr>
													<td><b>Role Description: </b>' . @$item->Responsibilities . '</td>
												</tr><br>';
					}

					$html .= '</table>
										</td>
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Qualification']) && !isset($response['Qualification']['0']->Message)) {
					$html .= '<div>	
									<table style="padding:3px 0px 3px 0px;">
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">EDUCATION</td>
									</tr>
									<tr>										
										<td colspan="2">
											<table style="padding:3px 3px 3x 3px;">';
					foreach ($response['Qualification'] as $item) {
						if ($item->Grade == 'Other – Please State') {
							$grade = $item->OtherGrade;
						} else {
							$grade = $item->Grade;
						}
						$html .= '<tr>
													<td style="background-color:#e6e6e6;border-spacing: 0px;">
														<span style="font-weight:bold;float:left;background-color:#e6e6e6;border-spacing: 0px;">' . @$item->University . '</span>
													</td>
													<td style="text-align:right;background-color:#e6e6e6;border-spacing: 0px;">
														<span style="font-weight:bold;float:right;">' . @$item->YearOfPassing . '</span>
													</td>
												</tr>
												<tr>
													<td>
														<span style="float:left;">' . @$item->Qualification . '</span><br/>
														<span style="float:left;">Grade: ' . @$grade . '</span><br/>
													</td>
												</tr>';
					}
					$html .= '</table></td></tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Certificate']) && !isset($response['Certificate']['0']->Message)) {
					$html .= '<div>	
								<table>
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">QUALIFICATIONS / CERTIFICATIONS</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="padding:3px 3px 3px 3px;">
											<tr>';
					$mod_count = 1;
					foreach ($response['Certificate'] as $item) {

						$html .= '<td colspan="2" style="font-family: arial;">
															<span>&#8226;  ' . @$item->Description . '</span>
															</td>';

						if ($mod_count % 2 == 0) {
							$html .= '</tr><tr>';
						}
						$mod_count++;
					}
					$html .= '<td></td><td></td>
												</tr></table>
										</td>	
									</tr>';
					$html .= '</table></div>';
				}
				$html .= '<div><span style="font-weight:bold;font-size:12px;">References Available Upon Request</span></div>';
				// output the HTML content
				$pdf->writeHTML($html, true, 0, true, 0);

				// echo $html;
				// exit;


				// reset pointer to the last page
				$pdf->lastPage();

				//Close and output PDF document
				$pdf->Output('cv.pdf', 'I');
				//          $file_name= time() . "_" . $UserID.'.pdf'; 
				// $pdf->Output(BASEPATH.'.'.CV_UPLOAD_PATH.$file_name,'F'); 
				// return $_result = $this->master_model->getQueryResult("call usp_M_UpdateDeleteCV('".$UserID."','".$file_name."','0','cv.pdf')");

			} else {
				echo 'User info not found.';
			}
		} else {
			echo 'User not found.';
		}
	}


	function cv_three($UserID = NULL)
	{
		$response = array();
		$response['data'] = $response['Qualification'] = $response['Project'] = $response['Language'] = $response['Certificate'] = $response['Employement'] = $response['Skill'] = array();
		if ($UserID != '') {
			ob_start();
			// require_once('C:/wamp64/www/SMBStayCheck_Admin/trunk/system/tcpdf/tcpdf.php');
			require_once BASEPATH . "tcpdf/tcpdf.php";
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Kunden Dadheech');
			$pdf->SetTitle('Candidate Detail');
			$pdf->SetSubject('Unique-HR');
			$pdf->SetKeywords('TCPDF, PDF');

			// set default header data
			// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'TCPDF HTML', PDF_HEADER_STRING);
			// $pdf->SetHeaderData('../../../../assets/admin/img/logo.png', PDF_HEADER_LOGO_WIDTH, 'Candidate Detail', 'Date : '.date('d-m-Y'));
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(BASEPATH . 'tcpdf/examples/lang/eng.php')) {
				require_once(BASEPATH . 'tcpdf/examples/lang/eng.php');
				if (!isset($l) || empty($l)) {
					$l = array();
					$l['a_meta_charset'] = 'UTF-8';
					$l['a_meta_dir'] = 'ltr';
					$l['a_meta_language'] = 'en';
					$l['w_page'] = 'page';
				}
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', '', 9);

			// add a page
			$pdf->AddPage();

			$_result['Profile'] = $this->master_model->getQueryResult("call usp_M_GetProfileByID('" . $UserID . "','" . base_url() . "')");
			if (isset($_result['Profile']) && !empty($_result['Profile']) && !isset($_result['Profile']['0']->Message)) {
				$response['Error'] = 200;
				$response['Message'] = 'Get CV data successfully.';
				$_result['Profile'][0]->CVDate = '';
				$mno_list = explode('-', $_result['Profile'][0]->MobileNo);
				$_result['Profile'][0]->CountryCode = '';
				if (count($mno_list) >= 2) {
					$_result['Profile'][0]->CountryCode = $mno_list[0];
					$_result['Profile'][0]->MobileNo = $mno_list[1];
				}

				if (isset($_result['Profile'][0]->CVPath) && $_result['Profile'][0]->CVPath != '' && file_exists(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name)) {
					//$_result[0]->CVDate = date ("F d Y H:i:s.", filemtime($_result[0]->CVPath));
					$lastModified = @filemtime(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name);
					if ($lastModified == NULL)
						$lastModified = filemtime(utf8_decode(str_replace('/system', '', BASEPATH) . CV_UPLOAD_PATH . $_result['Profile'][0]->CV_New_Name));
					$_result['Profile'][0]->CVDate = date("d M Y", $lastModified);
				}
				$response['data'] = $_result['Profile'][0];
				// print_r($response['data']); 

				$response['Qualification'] = $this->master_model->getQueryResult("call usp_M_GetUserQualificationByUserID('" . $UserID . "')");
				if (empty($response['Qualification']) || isset($response['Qualification']['0']->Message)) {
					$response['Qualification'] = array();
				}
				$response['Project'] = $this->master_model->getQueryResult("call usp_M_GetUserProjectByUserID('" . $UserID . "')");
				if (empty($response['Project']) || isset($response['Project']['0']->Message)) {
					$response['Project'] = array();
				}
				$response['Language'] = $this->master_model->getQueryResult("call usp_M_GetUserLanguageByUserID('" . $UserID . "')");
				if (empty($response['Language']) || isset($response['Language']['0']->Message)) {
					$response['Language'] = array();
				}
				$response['Certificate'] = $this->master_model->getQueryResult("call usp_M_GetUserCertificateByUserID('" . $UserID . "')");
				if (empty($response['Certificate']) || isset($response['Certificate']['0']->Message)) {
					$response['Certificate'] = array();
				}
				$response['Employement'] = $this->master_model->getQueryResult("call usp_M_GetUserEmployementByUserID('" . $UserID . "')");
				if (empty($response['Employement']) || isset($response['Employement']['0']->Message)) {
					$response['Employement'] = array();
				}

				$response['Skill'] = $this->master_model->getQueryResult("call usp_M_GetUserSkillByUserID('" . $UserID . "')");
				if (empty($response['Skill']) || isset($response['Skill']['0']->Message)) {
					$response['Skill'] = array();
				}
				$response['ProfileStep'] = $this->master_model->getInlineQuery("SELECT Fn_M_GetCandidateProfileStepPer('" . $UserID . "') as Action");
				if (empty($response['ProfileStep']['0']) || isset($response['ProfileStep']['0']->Message)) {
					$response['ProfileStep'] = array();
				} else {
					$list = explode('~', $response['ProfileStep']['0']->Action);
					if (!empty($list)) {
						$response['ProfileStep'] = array('Percentage' => @$list[0], 'RemainingAction' => @$list[1]);
					} else {
						$response['ProfileStep'] = array();
					}
				}
			} else if (isset($_result['Profile']['0']->Message) && $_result['Profile']['0']->Message != "") {
				$msg = explode('~', $_result['Profile']['0']->Message);
				$response['Error'] = ($msg[0]) ? $msg[0] : '103';
				$response['Message'] = $msg[1];
				$response['data'] = array();
			} else {
				$response['Error'] = 104;
				$response['Message'] = 'Error has been occurred please try again later.';
			}
			// return array('getCVData'=>$response);


			if ($response['Error'] == '200') {
				// create some HTML content
				//<img src="assets/admin/img/logo.png" width="100px" height="100px"><hr/>
				$html = '<table><tr>
									<td style="font-size:25px;padding:10px 0 0;font-family: arial;text-align:left;"><strong>' . strtoupper(@$response['data']->FirstName . ' ' . @$response['data']->LastName) . '</strong>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="border-bottom: 3px solid #000;">
										<table style="padding:3px 0px 3px 0px;">
											<tr>
												<td style="padding:10px 0px 0px 0px;">
													<span style="font-size:12px;float:left;">' . @$response['data']->MobileNo . ' &bull; ' . @$response['data']->EmailID . ' &bull; ' . @$response['data']->CityName . '</span>  
												</td>
												<td style="text-align:right;padding:10px 0px 0px 0px;">
													<span style="float:right;"><b>' . @$response['data']->StatusText . '</b></span>
												</td>
											</tr>
										</table>
									</td>
								</tr>
						</table><br/><br/>';
				if (!empty($response['data']->ProfileSummary)) {
					$html .= '<div style="">
								<table style="padding:3px 0px 3px 0px;">
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">PROFILE SUMMARY</td>
									</tr>
									<tr>
										<td style="font-size: 12px;font-family: arial; text-align: justify;" colspan="25">' . @$response['data']->ProfileSummary . '</td>
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Skill']) && !isset($response['Skill']['0']->Message)) {
					$html .= '<div>	
								<table>
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">KEY SKILLS</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Skill'] as $item) {

						$html .= '<tr>
															<td>&bull; ' . @$item->Name . '</td>
														  </tr>';
					}
					$html .= '</table>
										</td>	
									</tr>';
					$html .= '</table></div>';
				}

				if (!empty($response['Employement']) && !isset($response['Employement']['0']->Message)) {
					// print_r($response['Employement']);
					$html .= '<div>	
									<table>
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">EXPERIENCE</td>
									</tr>
									<tr>										
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Employement'] as $item) {
						$startDate = explode('/', $item->StartDate);
						$start_Date = date($startDate[2] . '-' . $startDate[1] . '-' . $startDate[0]);
						if ($item->EndDate != '') {
							$endDate = explode('/', $item->EndDate);
							$end_Date = date($endDate[2] . '-' . $endDate[1] . '-' . $endDate[0]);
						} else {
							$endDate = "Present";
						}
						$html .= '<tr>
													<td style="padding:10px 0px 30px 0px;">
														<span style="font-weight:bold;float:left;">' . @$item->Designation . '</span><br/>
														<span style="float:left;">' . @$item->OrganizationOther . ', ' . @$item->Location . '</span>
													</td>
													<td style="text-align:right;padding:0px 0px 30px 0px;">
														<span style="float:right;">' . date('F Y', strtotime(@$start_Date)) . ' - ' . ((@$end_Date) ? date('F Y', strtotime(@$end_Date)) : $endDate) . '</span>
													</td>
												</tr>
												<tr>
													<td>' . @$item->Responsibilities . '</td>
												</tr>';
					}

					$html .= '</table>
										</td>
									</tr>';
					$html .= '</table></div>';
				}
				if (!empty($response['Qualification']) && !isset($response['Qualification']['0']->Message)) {
					// print_r($response['Qualification']);
					$html .= '<div>	
									<table>
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">EDUCATION</td>
									</tr>
									<tr>										
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Qualification'] as $item) {
						if ($item->Grade == 'Other – Please State') {
							$grade = $item->OtherGrade;
						} else {
							$grade = $item->Grade;
						}
						$html .= '<tr>
													<td style="padding:10px 0px 30px 0px;">
														<span style="font-weight:bold;float:left;">' . @$item->University . '</span><br/>
														<span style="float:left;">' . @$item->Qualification . '</span><br/>
													</td>
													<td style="text-align:right;padding:10px 0px 30px 0px;">
														<span style="float:right;">' . @$item->YearOfPassing . '</span>
														<span></span>
														<br/>
													</td>
												</tr>';
					}
					$html .= '</table></td></tr>';
					$html .= '</table></div>';
				}

				if (!empty($response['Project']) && !isset($response['Project']['0']->Message)) {
					$html .= '<div>	
									<table>
									<tr>									
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">KEY PROJECTS</td>
									</tr>';
					$html .=	'<tr>										
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Project'] as $item) {

						$html .= '<tr><td style="font-weight:bold">' . @$item->ProjectTitle . '</td></tr>
											<tr><td><ul><li>' . @$item->ProjectDescription . '</li></ul></td></tr>';
					}
					$html .=			'</table>
										</td>
									</tr>';

					$html .= '</table></div>';
				}

				if (!empty($response['Certificate']) && !isset($response['Certificate']['0']->Message)) {
					// print_r($response['Certificate']);
					$html .= '<div>	
								<table>
									<tr>
										<td colspan="2" style="border-bottom: 1px solid #000;line-height: 24px;margin-bottom:0px !important;font-size:13px;padding:0px 0px 10px 0px; font-weight:bold; text-transform:uppercase;">QUALIFICATIONS / CERTIFICATIONS</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="padding:3px 0px 3px 0px;">';
					foreach ($response['Certificate'] as $item) {

						$html .= '<tr>
															<td style="padding:10px 0px 30px 0px;">
																<span style="font-weight:bold;float:left;">' . @$item->Description . '</span>
															</td>
															<td style="text-align:right;padding:10px 0px 30px 0px;">
																<span style="font-weight:bold;float:right;">' . @$item->CertificateYear . '</span>
															</td>
														  </tr><br>';
					}
					$html .= '</table>
										</td>	
									</tr>';
					$html .= '</table></div>';
				}
				$html .= '<div><span style="font-size:12px;">References Available Upon Request</span></div>';
				// output the HTML content
				$pdf->writeHTML($html, true, 0, true, 0);

				// echo $html;
				// exit;


				// reset pointer to the last page
				$pdf->lastPage();

				//Close and output PDF document
				$pdf->Output('cv.pdf', 'I');
				//          $file_name= time() . "_" . $UserID.'.pdf'; 
				// $pdf->Output(BASEPATH.'.'.CV_UPLOAD_PATH.$file_name,'F'); 
				// return $_result = $this->master_model->getQueryResult("call usp_M_UpdateDeleteCV('".$UserID."','".$file_name."','0','cv.pdf')");

			} else {
				echo 'User info not found.';
			}
		} else {
			echo 'User not found.';
		}
	}
}
