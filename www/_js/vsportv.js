function sh_hd(pl) 
{
    	var pl_bl = document.getElementById(pl);
    	var pl_text = document.getElementById(pl+'_txt');
    	pl_text.innerHTML = ( pl_bl.style.display == 'block' ) ? '<span id="'+pl+'_txt"><a href="javascript:void(0)" onclick="sh_hd(\''+pl+'\')" class="link_showhide">показать &darr;</a></span>' : ' ';

	pl_bl.style.display = ( pl_bl.style.display == 'block' ) ? 'none' : 'block';
}