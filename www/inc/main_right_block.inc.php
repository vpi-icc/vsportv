<? /*
<br /><br /><br />
<h4 class="grey">Ближайшие мероприятия</h4>
<p><strong>26&nbsp;октября</strong> в&nbsp;рамках Всероссийского дня спортивной гимнастики в&nbsp;Специализированной школе олимпийского резерва&nbsp;&#8470;&nbsp;2 (ул.&nbsp;Комсомольская,&nbsp;20) состоятся <strong><a href="/gallery/gymnasts/">выставочные соревнования</a></strong> воспитанников школы. Начало турнира&nbsp;&mdash; в&nbsp;10:00.</p>
<br />
*/ ?>

<br /><br />

<div>
  <object id="Flash" width="285px">
    <param name="movie" value="/_swf/vseros_fsk_230x100.swf">
    <param name="quality" value="high">
  <param name="wmode" value="transparent" />
  </object>
</div>
<br />
<? /*<h1 class="blueheader f16">Председатель комитета</h1>
<div id="gray_block">	
	<div class="fleft" style="margin: 0 15px 0 0;"> <img src="/_images/kohanovsky.jpg" alt="Сергей Викторович Кохановский" /></div>
	<h1>Сергей Викторович Кохановский<br /><span class="f10">председатель комитета</span></h1><br /><br /><br />    
	<p class="f16">Дорогие волжане!</p>
	<p>Во&nbsp;все времена Волжский считался одним из&nbsp;самых спортивных городов Юга России. Наша задача&nbsp;&mdash; высоко держать эту марку даже в&nbsp;условиях широкомасштабной бюджетной оптимизации.</p>
	<p><a href="/intro/">Читать полностью</a>...</p>
</div> */ ?>

<? /*
<div style="height:25px"></div>
<h1 class="redheader"><span class="f16" style="color: #fff">Поздравляем!</span></h1>
<div id="gray_block" class="cntr">
	<img src="/_images/romanenko.jpg" alt="Евгений Викторович Романенко" style="margin: 0 auto;" />
    <h1>Евгений Викторович Романенко<br /><span class="grey f10">двукратный чемпион Волжского по лёгкой атлетике и настольному теннису в весовой категории <nobr>до 75-ти килограммов</nobr></span></h1>
<ul id="ulpointer">

</ul>
*/ ?>
<br />
<br />
<h1>Популярные статьи</h1>
<br />
<?					
	$eventFavouritesListWriter = new EventFavouritesListWriter;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/eventFavouritesEntry.html';
	$eventFavouritesListWriter->setTemplate($template);	
	$eventsList = new EventsList;
	$eventsList->write($eventFavouritesListWriter);							
?>

</div>

<div style="height:20px;"></div>
<div style="height:20px;"></div>

<table class="vtop">
	<col width="50" />
    <tr>
        <td colspan="2" class="orange f20"><strong>История волжского спорта</strong><br /><br /></td>
    </tr>

	<tr>
        <td><img class="photo" src="/_images/kondrashov.jpg" alt="Владимир Кондрашов" /></td>
        <td><h1 class="top">Владимир Кондрашов<br /><span class="grey f12">Мастер спорта международного класса по дзюдо. Призер Кубка Мира и Европы</span></h1></td>
    </tr>
    <tr>
        <td><img class="photo" src="/_images/timoshkin.jpg" alt="Алексей Тимошкин" /></td>
        <td><h1>Алексей Тимошкин<br /><span class="grey f12">Мастер спорта международного класса по дзюдо. Призер чемпионатов и кубков Мира и Европы. Чемпион России</span></h1></td>
    </tr>
    <tr>
        <td><img class="photo" src="/_images/zhabko.jpg" alt="Ирина Жабко" /></td>
        <td><h1>Ирина Жабко<br /><span class="grey f12">Мастер спорта международного класса по гандболу. 4-х кратная чемпионка России. Чемпионка Мира среди студентов</span></h1></td>
    </tr>
</table>