{include file="file:$CommonDir/SysadHeader.html"}

<!--

include("../Common/CommonMethod.php");
CommonMethod::loginCheck();

	// DBサーバの障害対策。エラートラップという
	try
	{
		//DBに接続
		$dsn      = 'mysql:dbname=shop;host=localhost';
		$user     = 'shoper';
		$password = 'shoper';
		$dbh      = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES utf8');

		// sql文を使ってレコードを追加してます
		// where 1の「1」は「全部」という意味
		$sql    = 'SELECT code,name FROM mst_staff WHERE 1';
		$stmt   = $dbh->prepare($sql);
		$stmt->execute();

		// db接続を切断
		$dbh = null;

		print 'スタッフ一覧<br /><br />';

		// 修正画面に飛ぶ
		//print '<form method = "post" action = "staff_edit.php">';
		print '<form method = "post" action = "staff_branch.php">';

		while(true) {
			//$stmtから1レコード取り出してる
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);

			// もしもうデータがなければループから脱出
			if ($rec==false) {
				break;
			}

			//スタッフの名前を$stmtから1レコードずつ取り出しながら表示
			// データが亡くなったらループから脱出
			//ラジオボタンでスタッフを選べるように
			print '<input type = "radio" name = "staffcode" value="'.$rec['code'].'">';
			print $rec['name'];
			print '</br>';
		}

		print '<input type = "submit"  name="disp" value = "参照">';
		print '<input type = "submit"  name="add" value = "追加">';
		print '<input type = "submit"  name="edit" value = "修正">';
		print '<input type = "submit"  name="delete" value = "削除">';
		print '</form>';

	}
	// DBサーバーに障害が発生した時
	catch (exception $e) {
		print 'ただいま障害により大変ご迷惑をお掛けしております。';
		// 強制終了
		exit();
	}


-->
	
<body>

<div id="nf-main-contents">

    <div class="nf-main">


          <div class="nf-m-content">

<h2 class="nf-m-title">スタッフ一覧</h2>

<!--
<table class="table table-striped table-bordered">

<table class="table table-hover">
-->

{$this->Form->create()}

<div class="co-actionwrap bottom">
	<div class="co-actionarea">
<!--
{$this->Form->submit(__('登録'), array('name'=>'create', 'div'=>false, 'label'=>false))}

		<a class="btn btn-small" href="">{__('登録')}</a>
-->
		<span class="line">|</span>
<!--
{$this->Form->submit(__('削除'), array('name'=>'delete', 'div'=>false, 'label'=>false))}

		<a class="btn btn-small">{__('削除')}</a>
-->
	</div>
</div>
<br />

<table class="table table-striped table-bordered">

{foreach from=$arStaffs item=_item}
	<tr>
		<td class="co-chk"><input type="checkbox" value="{$_item.Staff.name}"></td>
		<td><a href="">{$_item.Staff.name}</a></td>	
	</tr>
{foreachelse}
	<tr>
		<td colspan="2" class="co-nodata">{__('該当するデータはありません。')}</td>
	</tr>
{/foreach}

</table>

<div class="co-actionwrap bottom">
	<div class="co-actionarea">
		<a class="btn btn-small" href="{cake_uri act=create}">{__('登録')}</a>
		<span class="line">|</span>
		<a class="btn btn-small">{__('削除')}</a>
	</div>
</div>

{$this->Form->end()}

{$smarty.const}

<h1>{$sampleValue}</h1>
<!--
{$this->Html->link('Yahoo' , 'http://www.yahoo.co.jp/')}
-->


<br />
<a href="../staff_login/staff_top.php">トップメニューへ</a><br />

</div><!--.nf-m-content-->

</div><!--.nf-main-->

</div><!--#nf-main-contents-->


</body>


