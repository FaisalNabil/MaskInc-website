  <?php

/**
 * Created by PhpStorm.
 * User: Riyad
 * Date: 4/1/2018
 * Time: 11:10 AM
 * Create Log for any CRUD operation
 */
class App_log
{
    private $agent = "";
    private $info = array();

    public function __construct()
    {
        $ci =& get_instance();
        $this->agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
        $this->getBrowser();
    }

    public function __get($var) {
        return get_instance()->$var;
    }

    public function create_log($log_name, $log_desc=NULL)
    {
        $emp_id = $this->session->userdata('employee_id') ? $this->session->userdata('employee_id') : '';
        $name = $this->session->userdata('name') ? $this->session->userdata('name') : '';
        $user_type = $this->session->userdata('user_type') ? $this->session->userdata('user_type') : 1;
        //$business_code = $this->session->userdata('business_code');
        $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));

        $log_array = array(
            'log_name'=> $log_name,
            'created_by'=> array(
                'emp_id'=> $emp_id,
                'name'=> $name,
                'user_type'=> $user_type
            ),
            'operation_ip'=>$this->input->ip_address(),
            'browser_info'=>$this->getBrowser(),
            'location'=>array(
                'lat'=> $geo['geoplugin_latitude'],
                'lon'=> $geo['geoplugin_longitude']
            ),
            'created_on'=> date('d-m-Y, H:i:s')
        );

        $ins_array = array(
            'log_name'=> $log_name,
            'created_by'=> $emp_id,
            'log_detail'=> json_encode($log_array),
            'description'=> json_encode($log_desc),
            'created_on'=> date('Y-m-d H:i:s')
        );

        if($this->db->insert('tbl_app_log', $ins_array)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getBrowser(){
        $browser = array("Navigator"            => "/Navigator(.*)/i",
            "Firefox"              => "/Firefox(.*)/i",
            "Internet Explorer"    => "/MSIE(.*)/i",
            "Google Chrome"        => "/chrome(.*)/i",
            "MAXTHON"              => "/MAXTHON(.*)/i",
            "Opera"                => "/Opera(.*)/i",
        );
        foreach($browser as $key => $value){
            if(preg_match($value, $this->agent)){
                $this->info = array_merge($this->info,array("Browser" => $key));
                $this->info = array_merge($this->info,array(
                    "Version" => $this->getVersion($key, $value, $this->agent)));
                break;
            }else{
                $this->info = array_merge($this->info,array("Browser" => "UnKnown"));
                $this->info = array_merge($this->info,array("Version" => "UnKnown"));
            }
        }
        return $this->info['Browser'];
    }

    public function getVersion($browser, $search, $string){
        $browser = $this->info['Browser'];
        $version = "";
        $browser = strtolower($browser);
        preg_match_all($search,$string,$match);
        switch($browser){
            case "firefox": $version = str_replace("/","",$match[1][0]);
                break;

            case "internet explorer": $version = substr($match[1][0],0,4);
                break;

            case "opera": $version = str_replace("/","",substr($match[1][0],0,5));
                break;

            case "navigator": $version = substr($match[1][0],1,7);
                break;

            case "maxthon": $version = str_replace(")","",$match[1][0]);
                break;

            case "google chrome": $version = substr($match[1][0],1,10);
        }
        return $version;
    }
}