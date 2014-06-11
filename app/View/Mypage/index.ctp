<div class="rows">
	<h1>マイページ</h1>
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">ご利用状況</h3>
	  </div>
	  <div class="panel-body">
	  <table class="table table-striped table-hover ">
        <tbody>
          <tr>
            <th>番号</th>
            <td><?php _h($user['phoneno']); ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th>登録名</th>
            <td><?php _h($user['name']); ?>　様</td>
            <td></td>
          </tr>
          <tr>
            <th>ご利用中の人数</th>
            <td><?php _h($usercount); ?> 名</td>
            <td><a href="#">編集</a></td>
          </tr>
          <tr>
            <th>ご利用中のオプション</th>
            <td>留守番電話 / 時間外対応</td>
            <td><a href="#">編集</a></td>
          </tr>
        </tbody>
      </table>
	  </div>
	</div>
</div>