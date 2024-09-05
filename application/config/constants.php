<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('REGISTRATION_FORM', serialize(array('IOS', 'Android', 'Admin', 'Web')));
define('USER_TYPE', serialize(array('1' => 'Admin', '2' => 'Vendor', '3' => 'Customer', '4' => 'Subscribe')));
define('REGISTRATION_TYPE', serialize(array('Regular', 'Facebook', 'GooglePlus', 'Twitter')));
//$reg_type = unserialize (REGISTRATION_TYPE); //use it
//define('BASEPATH');
define('ACTIVE', 1);
define('INACTIVE', 0);
define('PER_PAGE_RECORD', 30);
define('ADMIN', 1);

define('MALE', "Male");
define('FEMALE', "Female");
define('OTHER', "Other");
define('EXPERIENCE', "Experience");
define('FRESHER', "Fresher");
/* Alert Messages */
define('SUCCESS_ACTIVE_MESSEGE', 'Status is Active Now.');
define('SUCCESS_INACTIVE_MESSEGE', 'Status is InActive Now.');
define('SUCCESS_INSERT_MESSEGE', 'Record has been Added Successfully.');
define('SUCCESS_REQUIRED_MESSEGE', 'Enter all required field.');
define('SUCCESS_UPDATE_MESSEGE', 'Record has been Updated Successfully.');
define('CATCH_ERROR', 'Something went Wrong, Please Try Later.');
define('AMENITY_NOT_AVAILABLE', 'Amenity not Available');
define('ENTER_VALID_DATE', 'Enter Valid Date');
define('ReSOURCE_NOT_AVAILABLE', 'Resource not Available');

define('CHANGE_STATUS',    'status_change');
define('ACTIVE_ICON_CLASS', 'mdi-navigation-check status_change active_status_icon');
define('INACTIVE_ICON_CLASS', 'mdi-navigation-close status_change inactive_status_icon');
define('AACTIVE_ICON_CLASS', 'mdi-navigation-check active_status_icon');
define('AINACTIVE_ICON_CLASS', 'mdi-navigation-close inactive_status_icon');
define('LOADING_ICON_CLASS', 'fa fa-spinner fa-spin fa-fw margin-bottom loading_status_icon');
define('EDIT_ICON_CLASS', 'mdi-editor-mode-edit');
define('VIEW_ICON_CLASS', 'mdi-action-visibility');
define('INFO_ICON_CLASS', 'mdi-action-info');

define('PLUS_ICON_CLASS', 'fa fa-plus');
define('INTERVIEW_ICON_CLASS', 'mdi-social-person-add ');
define('SHORTLIST_ICON_CLASS', 'mdi-action-assignment ');
define('APPLIED_ICON_CLASS', 'mdi-toggle-check-box');

define('DEFAULT_IMAGE', 'assets/admin/img/noimage.gif');
define('DATE_TIME_FORMAT', 'd/m/Y H:i:s');
define('DATE_FORMAT', 'd/m/Y');
define('DEFAULT_DATE_TIME', '1000-01-01 00:00:00');
define('DEFAULT_DATE', '1000-01-01');
define('DATABASE_DATE_TIME_FORMAT', 'Y-m-d H:i:s');
define('DATABASE_DATE_FORMAT', 'Y-m-d');
define('DATABASE_YEAR', '1000');



/* For Category Image*/
define('CATEGORY_MAX_HEIGHT',    768);
define('CATEGORY_MAX_WIDTH',    1024);
define('CATEGORY_MAX_SIZE',    102400);
define('CATEGORY_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('CATEGORY_UPLOAD_PATH',    './assets/uploads/category/');

define('CATEGORY_THUMB_MAX_WIDTH',    250);
define('CATEGORY_THUMB_MAX_HEIGHT',    250);
define('CATEGORY_THUMB_UPLOAD_PATH',    './assets/uploads/category/thumbnail/');
/* End Category Image*/

/* For Advertisement Image*/
define('ADVERTISEMENT_MAX_HEIGHT',    768);
define('ADVERTISEMENT_MAX_WIDTH',    1024);
define('ADVERTISEMENT_MAX_SIZE',    102400);
define('ADVERTISEMENT_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('ADVERTISEMENT_UPLOAD_PATH',    './assets/uploads/advertisement/');

define('ADVERTISEMENT_THUMB_MAX_WIDTH',    250);
define('ADVERTISEMENT_THUMB_MAX_HEIGHT',    250);
define('ADVERTISEMENT_THUMB_UPLOAD_PATH',    './assets/uploads/advertisement/thumbnail/');
/* For Banner Image*/

/* For Banner Image*/
define('BANNER_MAX_HEIGHT',    768);
define('BANNER_MAX_WIDTH',    1024);
define('BANNER_MAX_SIZE',    102400);
define('BANNER_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('BANNER_UPLOAD_PATH',    './assets/uploads/banner/');

define('BANNER_THUMB_MAX_WIDTH',    250);
define('BANNER_THUMB_MAX_HEIGHT',    250);
define('BANNER_THUMB_UPLOAD_PATH',    './assets/uploads/banner/thumbnail/');
/* For Banner Image*/

/* For Banner MOBILE Image*/
define('BANNER_MOBILE_MAX_HEIGHT',    768);
define('BANNER_MOBILE_MAX_WIDTH',    1024);
define('BANNER_MOBILE_MAX_SIZE',    102400);
define('BANNER_MOBILE_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('BANNER_MOBILE_UPLOAD_PATH',    './assets/uploads/banner/mobile/');

define('BANNER_MOBILE_THUMB_MAX_WIDTH',    250);
define('BANNER_MOBILE_THUMB_MAX_HEIGHT', 250);
define('BANNER_MOBILE_THUMB_UPLOAD_PATH', './assets/uploads/banner/mobile/thumbnail/');
/* End Banner MOBILE Image*/

/* For Mentor Image*/
define('MENTOR_MAX_HEIGHT',    768);
define('MENTOR_MAX_WIDTH',    1024);
define('MENTOR_MAX_SIZE',    102400);
define('MENTOR_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('MENTOR_UPLOAD_PATH',    './assets/uploads/mentor/');

define('MENTOR_THUMB_MAX_WIDTH',    250);
define('MENTOR_THUMB_MAX_HEIGHT',    250);
define('MENTOR_THUMB_UPLOAD_PATH',    './assets/uploads/mentor/thumbnail/');
/* For Mentor Image*/

/* For Video Image*/
define('VIDEOIMAGE_MAX_HEIGHT',    768);
define('VIDEOIMAGE_MAX_WIDTH',    1024);
define('VIDEOIMAGE_MAX_SIZE',    102400);
define('VIDEOIMAGE_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('VIDEOIMAGE_UPLOAD_PATH',    './assets/uploads/video/videourl/');

define('VIDEOIMAGE_THUMB_MAX_WIDTH',    250);
define('VIDEOIMAGE_THUMB_MAX_HEIGHT',    250);
define('VIDEOIMAGE_THUMB_UPLOAD_PATH',    './assets/uploads/video/thumbnail/');
/* For Video Image*/

/* For Video URL*/
define('VIDEOURL_MAX_HEIGHT',    -1);
define('VIDEOURL_MAX_WIDTH',    -1);
define('VIDEOURL_MAX_SIZE',    -1);
define('VIDEOURL_ALLOWED_TYPES',    'gif|mpeg|mp4|m4v|wmv');
define('VIDEOURL_UPLOAD_PATH',    './assets/uploads/video/videourl/');

define('VIDEOURL_THUMB_MAX_WIDTH',    -1);
define('VIDEOURL_THUMB_MAX_HEIGHT',    -1);
define('VIDEOURL_THUMB_UPLOAD_PATH',    './assets/uploads/video/thumbnail/');
/* For Video URL*/


/* For Candidate Image*/
define('CANDIDATE_MAX_HEIGHT',    768);
define('CANDIDATE_MAX_WIDTH',    1024);
define('CANDIDATE_MAX_SIZE',    102400);
define('CANDIDATE_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('CANDIDATE_UPLOAD_PATH',    './assets/uploads/candidate/');

define('CANDIDATE_THUMB_MAX_WIDTH',    250);
define('CANDIDATE_THUMB_MAX_HEIGHT',    250);
define('CANDIDATE_THUMB_UPLOAD_PATH',    './assets/uploads/candidate/thumbnail/');
/* For Candidate Image*/

/* For Company Logo*/
define('COMPANYLOGO_MAX_HEIGHT',    768);
define('COMPANYLOGO_MAX_WIDTH',    1024);
define('COMPANYLOGO_MAX_SIZE',    102400);
define('COMPANYLOGO_ALLOWED_TYPES',    'gif|jpg|png|jpeg');
define('COMPANYLOGO_UPLOAD_PATH',    './assets/uploads/company/');

define('COMPANYLOGO_THUMB_MAX_WIDTH',    250);
define('COMPANYLOGO_THUMB_MAX_HEIGHT',    250);
define('COMPANYLOGO_THUMB_UPLOAD_PATH',    './assets/uploads/company/thumbnail/');
/* For Company Logo*/

/* For CV file*/
define('CV_MAX_SIZE', 102400);
define('CV_ALLOWED_TYPES',    'doc|docx|xls|xlsx|pdf|jpg|png|jpeg');
define('CV_UPLOAD_PATH',    './assets/uploads/cv/');

/* For CV file*/

define('DEFAULT_ADMIN_EMAIL', 'tester.saggisoftsolutions@gmail.com'); //'hairartist@virtualtryon.biz');
define('DEFAULT_ADMIN_EMAIL_PASSWORD', 'Tester@123');
define('DEFAULT_FROM_NAME', 'info');
define('DEFAULT_EMAIL_IMAGE', 'assets/front/images/email/');
define('DEFAULT_WEBSITE_TITLE', 'Unique-HR');

define('SALARY_FORM', serialize(array('Upto 30,000~0~30000', '45,001 to 70,000~45001~70000', '70,001 and above~70001~-1', 'All~-1~-1')));
define('GRADE_ARRAY', serialize(array('Postgraduate', 'Degree', 'Degree Ist', 'Degree 2.1', 'Degree 2.2', 'Degree 3rd', 'Degree Pass', 'HND', 'HNC', 'A Levels', 'BTEC', 'GCSE', 'Apprenticeship', 'None', 'Other – Please State')));
define('JOBTYPE_ARRAY', serialize(array('Graduate', 'Full-Time', 'Part-Time', 'Flexible', 'Fixed Term', 'Contract', 'Remote Working', 'Apprenticeship')));
define('STATUSTYPE_ARRAY', serialize(array('Available', 'At work, contact me via mail', 'Away from my desk', 'In a meeting', 'At lunch', 'Call between 5 and 6pm', 'Running low on battery – mail')));
define('VISASTATUS_ARRAY', serialize(array('Tier 1', 'Tier 2', 'Tier 5', 'Tier 4 – Study', 'Family', 'Visitor', 'ILR')));
define('REJECT_REASON_ARRAY', serialize(array('Please pick reason from list below', 'Not enough qualifications', 'Not enough relevant experience', 'Lack of digital skills', 'Wanted flexible working', 'Wanted remote working', 'Unable to work the hours proposed', 'Not right fit for the team', 'Other - Please state')));
define('NATUREOFEMPLOYMENT_ARRAY', serialize(array('Permanent', 'Contract', 'Fixed Term', 'Part Time', 'Office Based Only', 'Remote Working', 'Flexible Work Hours', 'Work from home flexibility', 'Returners Programme')));
define('DESIREDCANDIDATEPROFILE_ARRAY', serialize(array('UG', 'PG', 'Diploma', 'Not Required', 'Any', 'Other')));
