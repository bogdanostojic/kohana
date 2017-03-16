<?php defined('SYSPATH') or die('No direct script access.');
/** * Message Model * Handles CRUD for user messages */ 
class Model_Message extends ORM {    
    
    
    // Table name used by this model
    protected $_table = 'messages';   
    protected $_belongs_to = array('user' => array());
     /*  
     * Adds a new message for a user *  
     * @param   int   user_id   
     * @param   string   user's message 
     * @return  self   
     */  
    
    public function create_message($user_id, $content)    
    {     
        $this->clear();   
        $this->user_id = $user_id;  
        $this->content = $content;   
        $this->date_published = time(); 
        return $this->save();   }   
    /**    * Updates a message    *
    * @param  int message_id
    * @param  string   new message   
    * @return self    */
    
    public function update_message( $content)  
    {    
        $this->content = $content;    
        return $this->save();  
    }     
    

    /**  
    * Gets all messages    
    *   
    * @return  array

    */   
   public function get_all($limit = 10, $offset = 0, $user_id = null)  
   {      
       $this->order_by('date_published', 'DESC')
       ->limit($limit)
       ->offset($offset); 
            if ($user_id)   
            {      
                $this->where('user_id', '=', $user_id);     
            }   
    return $this->find_all(); 
   
   } 
          /**    
       * Updates a message  * 
       * @param  int  message_id  
       * @param  string content   
       * @return Database    */ 
    
        public function edit($message_id, $content)   
        {     
            return DB::update($this->_table)->set(array(         
                'content' => $content         ))->where('id', '=', $message_id)->execute();   
        }
    
    /**
    * Gets a message based on id    * 
    * @param  int  message_id   
    * @return  Database    */ 
    
    public function get_message($message_id)  
    {      
        return DB::select()->from($this->_table)->where('id', '=', $message_id)->execute()->current();
    }
    
        public function count_all($user_id = null) 
    {  
        $query = DB::select(DB::expr('COUNT(*) AS message_count'))->from($this->_table);
        if ($user_id)     
        {   
            $query->where('user_id', '=', (int) $user_id);    
        }
          return  $query->execute()->get('message_count'); 
    }
   /** 
   * Deletes a message from the DB    
   *   
   * @param   string   user_id
   * @param   string   user's message 
   * @return  Database  
   */   
               public function delete_message($id)   
           {    
               return DB::delete($this->_table)
                   ->where('id', '=', $id)
                   ->execute();   
           }
}