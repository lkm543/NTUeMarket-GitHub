<? include("header.php");

if (isset($_SESSION['MM_Username'])){
  header("Location: modify.php");
} else{
  ?>
  <br>
  <br>
  <br>
  <br>
  <div class="row">
    <div class="col-md-3 col-md-offset-2" style="margin-top:80px; min-width:300px; padding:0px 50px">
      <center>  <p style="margin:0px 0px 10px 0px; font-size:20px;">會員登入</p></center>
      <center>  <p style="margin:0px 0px 10px 0px;color:red; font-size:20px;"><?php echo $message;?></p></center>
      <form action="login_check.php" method="post" name="registration" >
        <div class="form-group">
          <label for="Account">帳戶名稱</label>
          <input type="text" class="form-control" name="username" placeholder="請輸入帳戶名稱">
        </div>
        <div class="form-group">
          <label for="password">用戶密碼</label>
          <input type="password" class="form-control" name="password" placeholder="請輸入用戶密碼">
        </div>
        <div style="text-align:center;">
        <button type="submit" class="btn btn-default" style="width:100%">登入</button>
        </div>
        <div style="font-style:italic; font-weight:bold; font-size:16px; text-align:center; color: rgb(171,171,140); margin:10px 0px;">OR</div>
        <div style="text-align:center"><a href="fbconfig.php"><img src="images/fbsignin.png" width="90%"></a></div>
      </form>
    </div>
    <div class="col-md-4 col-md-offset-1" style="margin-left:40px;">
      <div id="sing-up">
                      <form action="add_member_database.php" method="post" id="signup_form" name="signup_form" >
        <div style="text-align:center; width:387px"><p style="font-size:20px;">新用戶註冊</p></div>

        <textarea cols="52%" rows="8" readonly="readonly" style="margin-bottom:10px">親愛的 用戶您好：

          在你正式使用CollegeBazaar(以下簡稱本站)前，請先詳閱本使用者服務條款（以下稱為「本服務條款」）

          本條款之目的，在於盡力保護會員在使用本站服務時的權益，並確認本站與會員之間的權利義務關係，

          接受使用條款
          當您使用本服務條款時，即表示您已閱讀、瞭解並同意本服務條款之所有內容與約定，並完全接受本服務現有與未來衍生的服務項目及內容。
          本站有權於任何時間基於需要而修訂或變更本服務條款之內容，並取代先前的內容，修改後之服務條款將會公告於本站，恕不另行通知您，建議您隨時注意該等修改或變更。
          若您於任何修改或變更之後繼續使用本服務，即視為您已經閱讀、瞭解且同意接受修改或變更後之服務條款內容。
          若您不同意上述服務條款修改變更方式，或不接受本服務條款任一條款，您應立即停止使用本服務。
          如果您未滿二十歲，除應符合上述規定外，並應於您的家長(或監護人)閱讀、瞭解並同意本服務條款之所有內容及其後修改變更，才可以註冊會員、使用或繼續使用本服務。

          註冊義務
          您同意並保證以下事項：
          依本站之註冊提示，提供正確的個人資料（以下簡稱「註冊資料」），且無重覆註冊等事情。
          若您提供任何錯誤、不實、過時或不完整或具誤導性的資料；或者本站有理由懷疑前述資料為錯誤、不實、過時或不完整或具誤導性的，本站有權暫停或終止您的帳號，並拒絕您於現在和未來使用本站之全部或任何部分。
          您同意所登錄或留存之個人資料，本站可以在必要合理範圍或有助於本站服務之提供， 蒐集、處理、保存、傳遞及使用 您的註冊資料（包括但不限於提供予政府機關、司法警察及合作廠商）。 隱私權政策 本站對於您所登錄或留存之個人資料，在未獲得您的同意以前，都僅供本站及本站相關業務合作夥伴於其內部、依照原來所說明的使用目的和範圍加以使用，除非事先說明、或依照相關法律規定，否則本站不會將您的個人資料提供給第三人、或移作其他目的使用。本站會不定時通知會員所在單位的關於本服務之最新消息（包含相關活動、促銷方案等），會員可選擇拒絕。 您同意在 下列的情況下，本站有可能會提供您的個人資料給相關機關，或主張其權利受侵害並提示司法機關正式文件之第三人： 基於法律之規定、或受司法機關與其他有權機關基於法定程序之要求； 在緊急情況下為維護其他會員或其他第三人之合法權益； 為維護會員服務系統的正常運作； 會員透過本服務與租賃商品、購買商品、兌換贈品，因而產生的金流、物流必要資訊； 使用者有任何違反政府法令或本使用條款之情形。 會員帳號、密碼及安全 同意維護您的帳號及密碼的機密安全，您會在每次連線完畢後，登出並停止使用。當您發現您的帳號及密碼遭到盜用或安全問題發生時，您會立即通知本站。如果本站無法辨識使用過程是否為本人使用之情形，本站對此所致之損害，概不負責。 您同意您的帳號、密碼及會員權益均僅供您個人使用，不得轉借、轉讓他人或與他人共用。 使用者規範與行為 您同意不冒用他人名義使用本站。 您同意不參與任何非法目的或以任何非法方式使用本站，並遵守當地相關法規及網際網路使用規範。 您同意不會利用本站進行誹謗、侮辱、威脅、猥褻、干擾、不實、違反道德與公共秩序之文字、圖片或任何形式的檔案於本站。 您同意不傳播任何電腦病毒或破壞性程式碼。 您同意不使用惡意方式進行修改、刪除、干擾本站。 您同意不傳送任何未經許可的商業資料或廣告給本站之其他 使用者。 您同意遵守智慧財產權，不任意使用未經授權的圖片或任何形式的檔案於本站。 您同意不逕自使用、修改、重製、散布、發行、進行還原工程、解編或反向組譯 本站上的程式以及所有內容，包括但不限於著作、圖片、檔案、網站架構、網頁設計等，均由本站或其他權利人依法擁有其智慧財產權，包括但不限於商標權、專利權、著作權與專有技術等。 本站具備引用之功能，您同意您的作品發佈後，即同意他人引用您的作品至他人作品內。當您刪除該作品後，已被引用的作品將會繼續存在於本站。 創作者擁有著作之智慧財產權且擔保著作本身無違反著作權法及其它法規。未得創作者許可，您不得有修改、重製、轉貼之相關情事於營利行為。若您有涉及侵權之情事，本站有權停止您使用 本站，並取消會員資格。 對違反本服務條款行為之處置 您同意本站得依其判斷並認定您已經違反本服務條款之情事，本站有權終止或限制您使用本服務，並取消會員資格。 您同意本站可無條件將您的作品下架。 免責申明 當本站發生系統中斷，包括但不限於保養、施工、升級、故障或天災不可抗力之因素，也許會造成您的資料遺失、使用不便或其他損失，本站將不付任何賠償與責任。請您使用本站時，自行採取備份措施。 本站不保證系統程式不發生錯誤或障礙等情事，使用者自行採取備份措施。 本站於任何時刻，無論是否有公告或是通知使用者，都有權修改或終止任何服務項目，以及停止使用者使用權利。</textarea>

            <div style="text-align:left; width:387px">


                <div class="form-group" style="margin:0px">
                  <label for="account">用戶帳號(5-15個英文字母或數字)</label>
                  <input type="text" class="form-control" id="signup_user" name="username" placeholder="請輸入帳戶名稱" onBlur="validate('user_alert', this.value)">
                  <div id="user_alert" class="alert_msg"></div>
                </div>

                <div class="form-group" style="margin:0px">

                  <label for="email">電子郵件信箱</label>

                  <input type="email" class="form-control" id="signup_email" name="email" placeholder="請輸入電子郵件"  onBlur="validate('email_alert', this.value)">
                  <div id="email_alert" class="alert_msg"></div>
                </div>

                <div class="form-group" style="margin:0px">

                  <label for="password">用戶密碼(至少8碼)</label>

                  <input type="password" class="form-control" id="signup_pass" name="password" placeholder="請輸入用戶密碼" onBlur="validate('pass_alert', this.value)">
                  <div id="pass_alert" class="alert_msg"></div>
                </div>
                <div style="margin-top:10px">
                <center>

                  <button onclick="checkForm()" type="button" value="Submit" class="btn btn-default">&nbsp;&nbsp;註冊&nbsp;&nbsp;</button>&nbsp;&nbsp;

                  <button type="reset" class="btn btn-default">重新輸入</button>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }?>

    <? include("footer.php");?>