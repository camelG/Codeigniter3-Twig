# Codeigniter3.1.9 Twig2 Bootstrap4  

## Descript  
    *Codeigniter3.1.9  
    *Twig2  
    *Bootstrap4  
    *MY_Controller  
    *Sample_model  
    *Pagination Library  
※composer必要  
  
*PHP version 5.6 or newer is recommended.  
*MySQL (5.1+) via the mysql (deprecated), mysqli and pdo drivers  
*Oracle via the oci8 and pdo drivers  
*PostgreSQL via the postgre and pdo drivers  
*MS SQL via the mssql, sqlsrv (version 2005 and above only) and pdo drivers  
*SQLite via the sqlite (version 2), sqlite3 (version 3) and pdo drivers  
*CUBRID via the cubrid and pdo drivers  
*Interbase/Firebird via the ibase and pdo drivers  
*ODBC via the odbc and pdo drivers (you should know that ODBC is actually an abstraction layer)  

## Folder Structure  
```  
    codeigniter/  
    └── application/  
        └── vendor/  
            └── twig  
                └── twig  
```  

```  
    codeigniter/  
    └── application/  
        └── composer.json  
```

## MY_Controller.php  
    <?php
    class MY_Controller extends CI_Controller {
        protected $twig;
        
        public function __construct(){
            parent::__construct();
            
            $loader = new Twig_Loader_Filesystem('./application/views');
            // $this->twig = new Twig_Environment($loader, array('cache' => APPPATH.'/cache/twig', 'debug' => true));
            $this->twig = new Twig_Environment($loader);

            if( !empty($this->session->alert) ){
                $this->twig->addGlobal('alert', $this->session->alert);
                $this->session->alert = '';
            }

            if(!empty($this->session->user) ){
                unset($this->session->user->password);
                $this->twig->addGlobal('user', $this->session->user);
            }

            if(!empty($this->session->is_login) ){
                $this->twig->addGlobal('is_login', $this->session->is_login);
            }

            $this->twig->addGlobal('url', base_url());
            $this->twig->addGlobal('current_url', current_url());
            $this->twig->addGlobal('uri_string', uri_string());

            // $this->output->enable_profiler('TRUE');
        }

    }
## Paginationmaker.php  
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Paginationmaker {

        public function make($get = [], $cnt = 1, $page = 1, $limit = 20, $start = 0){
            
            if( empty($get['page']) || (int)$get['page'] < 1 ){
                $get['page'] = $page;
            }
            
            if( empty($get['limit']) || (int)$get['limit'] < 1 ){
                $get['limit'] = $limit;
            }
            $data = $get;

            if((int)$get['page'] > 1){
                $data['start'] = ( (int)$get['page'] * (int)$get['limit'] ) - (int)$get['limit'];
            }else{
                $data['start'] = 0;
            }

            $data['pager'] = ceil( $cnt/(int)$get['limit'] ) ?: 1;
            unset($get['page']);
            $data['search_url'] = http_build_query($get);
            
            return $data;
        }
        
    }