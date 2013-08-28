<?php

class WebUser extends CWebUser {

	// Store model to not repeat query.
	private $_model;
	private $_role;
 
  	// Return name.
  	function getName(){
    	$user = $this->loadUser(Yii::app()->user->id);
    	return $user->name;
  	}
  	
	// Return sur name.
  	function getSurName(){
    	$user = $this->loadUser(Yii::app()->user->id);
    	return $user->surname;
  	}
  	
	// Return role.
  	function getRole(){
    	$user = $this->loadUser(Yii::app()->user->id);
		
		// Get Employee Type by id_employy_type
		$userRole=EmployeeType::model()->findByPk($user->id_employee_type);
		
    	return $userRole->description;
    	//return $user->id_employee_type;
  	}
 
  	// This is a function that checks the field 'role'
  	// in the User model to be equal to 1, that means it's admin
  	// access it by Yii::app()->user->isAdmin()
  	function isAdmin(){
    	$user = $this->loadUser(Yii::app()->user->id);
		
    	return $this->getRole() == "admin";
  	}
	
  	function isManager(){
    	$user = $this->loadUser(Yii::app()->user->id);
		
    	return $this->getRole() == "manager";
  	}
 
  	// Load user model.
  	protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
			{
                $this->_model=Employee::model()->findByPk($id);
			}
        }
        return $this->_model;
    }
}

?>