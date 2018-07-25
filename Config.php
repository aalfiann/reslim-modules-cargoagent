<?php
namespace modules\cargoagent;                   //Make sure namespace is same structure with parent directory

use \classes\Auth as Auth;                          //For authentication internal user
use \classes\JSON as JSON;                          //For handling JSON in better way
use \classes\CustomHandlers as CustomHandlers;      //To get default response message
use \classes\Validation as Validation;              //To validate the string
use PDO;                                            //To connect with database

	/**
     * A class for agent configuration
     *
     * @package    Config Cargo Agent
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/reSlim-modules-cargoagent/blob/master/LICENSE.md  MIT License
     */
    class Config {

        // database var
		protected $db;
		
		//base var
        protected $basepath,$baseurl,$basemod;

        //master var
        var $username,$token;

        //data var
		var $key,$value,$description,$created_at,$created_by,$updated_at,$updated_by;

        //search var
        var $search;
        
        //pagination var
		var $page,$itemsPerPage;
		
		//multi language
		var $lang;
        
        //construct database object
        function __construct($db=null,$baseurl=null) {
			if (!empty($db)) $this->db = $db;
            $this->baseurl = (($this->isHttps())?'https://':'http://').$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
			$this->basepath = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
            $this->basemod = dirname(__FILE__);
        }
        
        //Detect scheme host
        function isHttps() {
            $whitelist = array(
                '127.0.0.1',
                '::1'
            );
            
            if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                if (!empty($_SERVER['HTTP_CF_VISITOR'])){
                    return isset($_SERVER['HTTPS']) ||
                    ($visitor = json_decode($_SERVER['HTTP_CF_VISITOR'])) &&
                    $visitor->scheme == 'https';
                } else {
                    return isset($_SERVER['HTTPS']);
                }
            } else {
                return 0;
            }            
        }

        //Get modules information
        public function viewInfo(){
            return file_get_contents($this->basemod.'/package.json');
        }


        //Config===========================================


        public function add(){
            if (Auth::validToken($this->db,$this->token,$this->username)){
    		    try {
    				$this->db->beginTransaction();
	    			$sql = "INSERT INTO agent_config (KeyID,Config,Description,Created_at,Created_by) 
		    			VALUES (:key,:value,:description,current_timestamp,:created_by);";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':key', $this->key, PDO::PARAM_STR);
					$stmt->bindParam(':value', $this->value, PDO::PARAM_STR);
					$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
					$stmt->bindParam(':created_by', $this->username, PDO::PARAM_STR);
                    if ($stmt->execute()) {
						$data = [
							'status' => 'success',
							'code' => 'RS101',
							'message' => CustomHandlers::getreSlimMessage('RS101',$this->lang)
						];	
					} else {
    					$data = [
					    	'status' => 'error',
				    		'code' => 'RS201',
			    			'message' => CustomHandlers::getreSlimMessage('RS201',$this->lang)
		    			];
	    			}
	    			$this->db->commit();
    			} catch (PDOException $e) {
			        $data = [
    	    			'status' => 'error',
	    				'code' => $e->getCode(),
    	    			'message' => $e->getMessage()
    			    ];
	    		    $this->db->rollBack();
    		    }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
            }

			return JSON::encode($data,true);
			$this->db = null;
        }

        public function update() {
            if (Auth::validToken($this->db,$this->token,$this->username)){
    		    try {
    				$this->db->beginTransaction();
	    			$sql = "UPDATE agent_config 
                        SET Config=:value,Description=:description,Updated_at=current_timestamp,Updated_by=:updated_by
                        WHERE KeyID=:key;";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':value', $this->value, PDO::PARAM_STR);
					$stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
					$stmt->bindParam(':updated_by', $this->username, PDO::PARAM_STR);
					$stmt->bindParam(':key', $this->key, PDO::PARAM_STR);
                    if ($stmt->execute()) {
						$data = [
							'status' => 'success',
							'code' => 'RS103',
							'message' => CustomHandlers::getreSlimMessage('RS103',$this->lang)
						];	
					} else {
    					$data = [
					    	'status' => 'error',
				    		'code' => 'RS203',
			    			'message' => CustomHandlers::getreSlimMessage('RS203',$this->lang)
		    			];
	    			}
	    			$this->db->commit();
    			} catch (PDOException $e) {
			        $data = [
    	    			'status' => 'error',
	    				'code' => $e->getCode(),
    	    			'message' => $e->getMessage()
    			    ];
	    		    $this->db->rollBack();
    		    }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
            }

			return JSON::encode($data,true);
			$this->db = null;
        }

        public function delete() {
            if (Auth::validToken($this->db,$this->token,$this->username)){
    		    try {
    				$this->db->beginTransaction();
	    			$sql = "DELETE FROM agent_config WHERE KeyID=:key;";
					$stmt = $this->db->prepare($sql);
					$stmt->bindParam(':key', $this->key, PDO::PARAM_STR);
                    if ($stmt->execute()) {
						$data = [
							'status' => 'success',
							'code' => 'RS104',
							'message' => CustomHandlers::getreSlimMessage('RS104',$this->lang)
						];	
					} else {
    					$data = [
					    	'status' => 'error',
				    		'code' => 'RS204',
			    			'message' => CustomHandlers::getreSlimMessage('RS204',$this->lang)
		    			];
	    			}
	    			$this->db->commit();
    			} catch (PDOException $e) {
			        $data = [
    	    			'status' => 'error',
	    				'code' => $e->getCode(),
    	    			'message' => $e->getMessage()
    			    ];
	    		    $this->db->rollBack();
    		    }
            } else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
            }

			return JSON::encode($data,true);
			$this->db = null;
        }

        public function read() {
            if (Auth::validToken($this->db,$this->token,$this->username)){
				//calculate KeyID
				$datakey = explode(',',$this->key);
				$listkeys = "";
				$listdata = "{";
				$n=0;
				foreach($datakey as $key){
					if(!empty(trim($key))){
						$listkeys .= 'KeyID = :key'.$n.' or ';
    					$listdata .= '":key'.$n.'":"'.trim($key).'",';
						$n++;
					}
				}

				$listkeys = rtrim($listkeys," or ");
				$listdata = rtrim($listdata,",").'}';

				if ($n > 1){
					$sql = "SELECT KeyID,Config,Description,Created_at,Created_by,Updated_at,Updated_by
						FROM agent_config 
						WHERE ".$listkeys.";";
				
					$stmt = $this->db->prepare($sql);
					if ($stmt->execute(json_decode($listdata,true))) {	
						$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						if ($stmt->rowCount() > 0){
							$data = [
								'result' => $results, 
								'status' => 'success', 
								'code' => 'RS501',
								'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
							];
						} else {
							$data = [
								'result' => [],
								'status' => 'error',
								'code' => 'RS601',
								'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
							];
						}          	   	
					} else {
						$data = [
							'status' => 'error',
							'code' => 'RS202',
							'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
						];
					}
				} else {
					$sql = "SELECT KeyID,Config,Description,Created_at,Created_by,Updated_at,Updated_by
						FROM agent_config
						WHERE KeyID = :key LIMIT 1;";
				
					$stmt = $this->db->prepare($sql);		
					$stmt->bindParam(':key', $this->key, PDO::PARAM_STR);

					if ($stmt->execute()) {	
						$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						if ($stmt->rowCount() > 0){
							$data = [
								'result' => $results, 
								'status' => 'success', 
								'code' => 'RS501',
								'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
							];
						} else {
							$data = [
								'result' => [],
								'status' => 'error',
								'code' => 'RS601',
								'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
							];
						}          	   	
					} else {
						$data = [
							'status' => 'error',
							'code' => 'RS202',
							'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
						];
					}
				}
			} else {
                $data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}
			
			return JSON::encode($data,true);
	        $this->db = null;
		}
		
		public function readPublic() {
			//calculate KeyID
			$datakey = explode(',',$this->key);
			$listkeys = "";
			$listdata = "{";
			$n=0;
			foreach($datakey as $key){
				if(!empty(trim($key))){
					$listkeys .= 'KeyID = :key'.$n.' or ';
					$listdata .= '":key'.$n.'":"'.trim($key).'",';
					$n++;
				}
			}

			$listkeys = rtrim($listkeys," or ");
			$listdata = rtrim($listdata,",").'}';

			if ($n > 1){
				$sql = "SELECT KeyID,Config,Description,Created_at,Created_by,Updated_at,Updated_by
					FROM agent_config
					WHERE ".$listkeys.";";
			
				$stmt = $this->db->prepare($sql);
				if ($stmt->execute(json_decode($listdata,true))) {	
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if ($stmt->rowCount() > 0){
						$data = [
							'result' => $results, 
							'status' => 'success', 
							'code' => 'RS501',
							'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
					} else {
						$data = [
							'result' => [],
							'status' => 'error',
							'code' => 'RS601',
							'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
					}          	   	
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS202',
						'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
			} else {
				$sql = "SELECT KeyID,Config,Description,Created_at,Created_by,Updated_at,Updated_by
					FROM agent_config
					WHERE KeyID = :key LIMIT 1;";
			
				$stmt = $this->db->prepare($sql);		
				$stmt->bindParam(':key', $this->key, PDO::PARAM_STR);

				if ($stmt->execute()) {	
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if ($stmt->rowCount() > 0){
						$data = [
							'result' => $results, 
							'status' => 'success', 
							'code' => 'RS501',
							'message' => CustomHandlers::getreSlimMessage('RS501',$this->lang)
						];
					} else {
						$data = [
							'result' => [],
							'status' => 'error',
							'code' => 'RS601',
							'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
					}          	   	
				} else {
					$data = [
						'status' => 'error',
						'code' => 'RS202',
						'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
			}
			
			return JSON::encode($data,true);
	        $this->db = null;
        }

        public function index() {
            if (Auth::validToken($this->db,$this->token)){
				$search = "%$this->search%";
				//count total row
				$sqlcountrow = "SELECT count(KeyID) as TotalRow 
					from agent_config
					where KeyID like :search
					order by KeyID asc;";
				$stmt = $this->db->prepare($sqlcountrow);		
				$stmt->bindParam(':search', $search, PDO::PARAM_STR);
				
				if ($stmt->execute()) {	
                    $single = $stmt->fetch();
    	    		if ($stmt->rowCount() > 0){
						
						// Paginate won't work if page and items per page is negative.
						// So make sure that page and items per page is always return minimum zero number.
						$newpage = Validation::integerOnly($this->page);
						$newitemsperpage = Validation::integerOnly($this->itemsPerPage);
						$limits = (((($newpage-1)*$newitemsperpage) <= 0)?0:(($newpage-1)*$newitemsperpage));
						$offsets = (($newitemsperpage <= 0)?0:$newitemsperpage);

						// Query Data
						$sql = "SELECT KeyID,Config,Description,Created_at,Created_by,Updated_at,Updated_by 
							from agent_config
							where KeyID like :search
							order by KeyID asc LIMIT :limpage , :offpage;";
						$stmt2 = $this->db->prepare($sql);
						$stmt2->bindParam(':search', $search, PDO::PARAM_STR);
						$stmt2->bindValue(':limpage', (INT) $limits, PDO::PARAM_INT);
						$stmt2->bindValue(':offpage', (INT) $offsets, PDO::PARAM_INT);
						
						if ($stmt2->execute()){
							$pagination = new \classes\Pagination();
							$pagination->lang = $this->lang;
							$pagination->totalRow = $single['TotalRow'];
							$pagination->page = $this->page;
							$pagination->itemsPerPage = $this->itemsPerPage;
							$pagination->fetchAllAssoc = $stmt2->fetchAll(PDO::FETCH_ASSOC);
							$data = $pagination->toDataArray();
						} else {
							$data = [
        	    	    		'status' => 'error',
		        		    	'code' => 'RS202',
	    			    	    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
							];	
						}			
				    } else {
    	    			$data = [
        	    			'status' => 'error',
		    	    		'code' => 'RS601',
        			    	'message' => CustomHandlers::getreSlimMessage('RS601',$this->lang)
						];
		    	    }          	   	
				} else {
					$data = [
    	    			'status' => 'error',
						'code' => 'RS202',
	        		    'message' => CustomHandlers::getreSlimMessage('RS202',$this->lang)
					];
				}
				
			} else {
				$data = [
	    			'status' => 'error',
					'code' => 'RS401',
        	    	'message' => CustomHandlers::getreSlimMessage('RS401',$this->lang)
				];
			}		
        
			return JSON::safeEncode($data,true);
	        $this->db = null;
		}
		
		public function get($key){
			$sql = "SELECT KeyID,Config,Description,Created_at,Created_by,Updated_at,Updated_by
					FROM agent_config
					WHERE KeyID = :key LIMIT 1;";
				
			$stmt = $this->db->prepare($sql);		
			$stmt->bindParam(':key', $key, PDO::PARAM_STR);

			if ($stmt->execute()) {	
				$result = $stmt->fetch();
    	        if ($stmt->rowCount() > 0){
					$data = $result['value'];
		        } else {
        			$data = "";
	    	    }  	   	
			} else {
				$data = "";
			}
			return $data;
			$this->db = null;
		}

    }    