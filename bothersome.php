<?php
if ($banStatus == 0) {
    echo '<form method="POST" action="profiles.php?id='.$id.'" enctype="multipart/form-data">
            <div>
            <button type="submit" class="btn" style="padding:10px;
  font-size:14px; height:27px;width:150px;" name="ban">Ban this user</button>
            </div>
            </form>';
}
if ($banStatus != 0) {
    echo '<form method="POST" action="profiles.php?id='.$id.' enctype="multipart/form-data">
            <div>
            <button type="submit" class="btn" style="padding:10px;
  font-size:14px; height:27px;width:150px;" name="unban">Unban this user</button>
            </div>
            </form>';
}
if ($modStatus == 0) {
    echo '<form method="POST" action="profiles.php?id='.$id.'" enctype="multipart/form-data">
            <div>
            <button type="submit" class="btn" style="padding:10px;
  font-size:14px; height:27px;width:150px;" name="mod">Promote this user</button>
            </div>
            </form>';
}
if ($modStatus != 0) {
    echo '<form method="POST" action="profiles.php?id='.$id.' enctype="multipart/form-data">
            <div>
            <button type="submit" class="btn" style="padding:10px;
  font-size:14px; height:27px;width:150px;" name="unmod">Demote this user</button>
            </div>
            </form>';
}
?>