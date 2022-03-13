<?php
    class Controller
    {
        // Redirects to another view
        protected function pageRedirect($url)
		{
			header('Location:'.$url);
		}

        /* Handles the Model View Controller of the application
           Based on the action passed from the view through GET method, it selects the right action to take*/
        public function mvcHandler()
        {
            $action = isset($_GET['act']) ? $_GET['act'] : NULL;
            switch ($action) 
            {
                case 'add' :       
                    $this->insert();
                    break;		
                case 'update':
                    $this->update();
                    break;				
                case 'delete' :
                    $this->delete();
                    break;			
                default:
                    $this->list();
            }
        }
    }
?>