<!--<h2 style="margin-bottom:3px;">Ближайшие события</h2>
            <div class="next_events">
              <table>
                <tr>
                  <td><div>10<span>.05</span></div></td>
                  <td>ул. Набережная 6, КФП &laquo;Волга&raquo;, 11:00</td>
                </tr>
              </table>
              <h2>Юбилей АМУ ФКС &laquo;Волжанин&raquo;</h2>
              <p class="lead">В программе фестиваля: показательные выступления воспитанников учреждения, а так же, награждение тренеров и спортсменов «Волжанина». Приглашаются все желающие. Вход свободный.</p>
            </div>
            <div class="next_events">
              <table>
                <tr>
                  <td><div>12<span>.05</span></div></td>
                  <td>спорткомлпекс «Молодость», 11:00</td>
                </tr>
              </table>
              <h2><a href="#">День здоровья — 2014</a></h2>
              <p class="lead">12 мая в 11:00 в спорткомплексе «Молодость» состоится спортивный праздник! Приглашаются первокурсники, преподаватели и все желающие! Приходите за победой!</p>
            </div>
            <div class="next_events">
              <table>
                <tr>
                  <td><div>12<span>.05</span></div></td>
                  <td>спорткомлпекс «Молодость», 11:00</td>
                </tr>
              </table>
              <h2><a href="#">День здоровья — 2014</a></h2>
              <p class="lead">12 мая в 11:00 в спорткомплексе «Молодость» состоится спортивный праздник! Приглашаются первокурсники, преподаватели и все желающие! Приходите за победой!</p>
            </div>-->
            <!--<a href="#"><img src="./_images/main/football_our_life.png" alt="Футбол - наша жизнь"></a>
            <div class="Flash">
			  <object id="Flash" width="250px">
			    <param name="movie" value="http://vsportv.ru/_swf/vseros_fsk_230x100.swf">
			    <param name="quality" value="high">
			  <param name="wmode" value="transparent">
			  </object>
			</div>-->
<!-- <div style="width:250px; height:440px;">&nbsp;</div> -->
<?
	$announceList = new AnnounceList;
    $announceWriter = new AnnounceWriter;
    $template = $_SERVER['DOCUMENT_ROOT'] . '/app/views/announceCard.html';
    $announceWriter->setTemplate($template);
    $announceList->write($announceWriter);
    ?>
<h2>История волжского спорта в&nbsp;лицах и&nbsp;фактах</h2>
<div class="history">
    <a href="/?section=press&id=79"><img src="./_images/main/ha4iperadze.png" alt="Анатолий Хачиперадзе"></a><p><span><a href="/?section=press&id=79">Анатолий Хачиперадзе</a></span><br />тренер по&nbsp;бальным танцам</p>
</div>
<br /><br />
<a href="#"><img src="./_images/main/football_our_life.png" alt="Футбол - наша жизнь"></a><div class="Flash">
    <object id="Flash" width="250px">
        <param name="movie" value="./_swf/vseros_fsk_230x100.swf">
        <param name="quality" value="high">
        <param name="wmode" value="transparent">
    </object>
</div>