<?php defined('SYSPATH') or die('No direct script access.');
/** * Message Model * Handles CRUD for user messages */ 
class Model_Message {    
    
    // Table name used by this model
    protected $_table = 'messages';   
    /**    * Adds a new message for a user   
    *  
    * @param   string   user_id   
    * @param   string   user's message  
    * @return  Database    */ 
    public function add($user_id, $message)
    {      

        $data = array('user_id', 'author', 'date_published');
        return DB::insert($this->_table, $data)->values($user_id, $message, time())->execute(); 
    }

    /**  
    * Gets all messages    
    *   
    * @return  array

    */   
    public function get_all($limit = 10, $offset = 0)  
    {      
                return DB::select()    
             ->from($this->_table)  
             ->order_by('date_published')   
             ->limit($limit)    
             ->offset($offset)   
             ->execute()    
             ->as_array(); 
    }
    
        public function count_all() 
    {  
        return DB::select(DB::expr('COUNT(*) AS message_count'))
            ->from($this->_table)
            ->execute()->get('message_count'); 
    }
   /** 
   * Deletes a message from the DB    
   *   
   * @param   string   user_id
   * @param   string   user's message 
   * @return  Database  
   */   
    public function delete($user_id, $message)  
    {    
return DB::delete($this->_table)->where('user_id', '=', $user_id)->where('message', '=',$message)->execute();  
    }
}