<?	
	if ( !isset($_SESSION['form_uid']) ) $_SESSION['form_uid'] = rand(1000, 9999);
?>

<link rel="stylesheet" href="/data/articles/velo_online/input_form.css" />
<script type="text/javascript" src="/data/articles/velo_online/input_form.js"></script>

<div>	
    <div class="inputform">    	
        <div id="inputform_inner">
        	<form action="#" id="regform">
        	<table class="placeholder inputformtable">        		
        	    <col />
                <col width="33%" />
        		<tr>
	                <td colspan="2">
                    	Укажите, пожалуйста, ваши фамилию, имя и&nbsp;отчество<br /><br />
                    	<table class="placeholder2 fullwidth">
                    		<tr>
                    			<td class="cntr"><input type="text" name="surname" id="surname" class="fullwidth" /><span class="f10">(фамилия)</span></td>                    		
                    			<td class="cntr"><input type="text" name="name" id="name" class="fullwidth" /><span class="f10">(имя)</span></td>
                    			<td class="cntr"><input type="text" name="patronymic" id="patronymic" class="fullwidth" /><span class="f10">(отчество)</span></td>
                    		</tr>
                    	</table>
                    </td>
                </tr>    
        	</table>                
        	<table width="100%" id="send_block">
            	<col width="50" />
        		<tr>
        			<td><img src="/data/articles/velo_online/captcha.php?<?=rand(1, 100)?>" /></td>
        			<td><br /><input type="text" name="form_uid"  id="form_uid" maxlength="4" /><br /><span class="f10 grey">(&larr;&nbsp;подтвердите, что вы&nbsp;человек)</span></td>                
                    <td class="rght"><br /><input type="submit" name="btn_send" id="btn_send" value="Зарегистрироваться" /></td>
        		</tr>
        	</table>
           	</form>
        	<br />
        	<div id="process" style="display: none; text-align:center;"><img src="/_images/_icons/ajaxLoading2.gif" />&nbsp;Запрашиваю...</div>    	        
        	<div id="note_error" style="display: none;" class="left"><span id="error_text"></span></div>
        </div>
        <div id="response_success">
            <p id="success_msg"></p>
            <p id="success_descr"></p>
        </div>
        <div id="response_failure">
            <p id="error_msg"></p>
            <p id="error_descr"></p>
        </div>
        
    </div>   
</div>