<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends SiteController
{
    public function __construct() {
        
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
       
        $this->bar = 'left';
        $this->template = env('THEME').'.contacts';
    }
    
   
    
    public function index(Request $request) {
        
        if($request->isMethod('post')) {
            
            $messages = [
              'required' => 'Поля :attribute обязательно к заполнению',
              'email' =>'Поле :attribute должно соответствовать email адресу'
            ];
            
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'message' => 'required'
            ]/*, $messages*/);
           
            $data = $request->all();
            
            //mail
           /* $result =Mail::send('site.email',['data'=>$data], function($message) use ($data) {
            
               $mail_admin = env('MAIL_ADMIN');
               $message->from($data['email'],$data['name']);
               $message->from($mail_admin)->subject('Question');
            });
            
                $name = $data['name'];  
                $email = $data['email'];
                $text = $data['text'];
                $mail_admin = env('MAIL_ADMIN');


                $address  = 'sergrib@mail.ru';
                $mes = "Тема: Заказ!\nИмя: $name\nПочта: $email\nСообщения:$text";   
                $sub='Заказ'; 
    
                $send = mail ($address,$sub,$mes,"Content-type:html/plain; charset = utf-8\r\nFrom:$mail_admin");
            
            
            
            if ($send){
                return redirect()->route('home')->with('status','Email is sent');
            }*/
            return redirect()->route('contacts')->with('status','Email is sent');
        }
        
            $this->title = 'Контакты';
        
        $content = view(env('THEME').'.contact_content')->render();
        $this->vars = array_add($this->vars,'content',$content);
        $this->contentLeftBar =  view(env('THEME').'.contact_bar')->render();
        
        return $this->renderOutput();    

        
    }    
    
    
    
}
































