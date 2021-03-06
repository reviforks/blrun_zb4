
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="width=device-width">
<title></title>
<style type="text/css">
<!--
	body, table, tr, td, ul, li {FONT-SIZE: 9pt; FONT-FAMILY: "나눔고딕","돋움",gulim,arial;}
	h3 {
		height:25px;
		padding-left:15px;
		background-repeat:no-repeat;
		padding-bottom:5px;
		font-family:"나눔고딕",dotum;
		font-size:15px;
		color:#006600;
		width:200px;
		border-bottom:2px solid #344834;
	}

	.tb_line { border:1px solid #666666;margin:0px;padding:0px;border-collapse:collapse;}
	.tb_line th { border:1px solid #666666;background-color:#afafaf;text-align:center;color:white;}
	.tb_line td { height:25px;font-size:12px}
	.tb_line td { border:1px solid #666666;}
	.tb_line td input#size150 { width:150px }
	.tb_line td input#size100 { width:100px }
	.tb_line td input#size80 { width:80px }
	.tb_line td input#size70 { width:70px }
	.tb_line td input#size50 { width:50px }
	.tb_line td input#size30 { width:30px }
	.tb_line td input#size20 { width:20px }
	.tb_line td input#chkbox { width:18px }
-->
</style>
<? include "script/popup.php"; ?>
<script>
function insertCode() {
	if(typeof(opener)=='undefined') return;
	var f = document.frm;
	var content = f.source.value;
	var title = f.code_sbj.value;
	var rownum = f.code_row.value;
	var code_type = f.code_type.value;

	if(!title) {
		alert("라벨을 입력하세요!");
		f.code_sbj.focus();
		return false;
	}
	else if(title.indexOf("\"")>=0) {
		alert("\" 는 사용불가입니다!");
		f.code_sbj.value="";
		f.code_sbj.focus();
		return false;
	}
	else if(title.indexOf("\{")>=0 || title.indexOf("\}")>=0) {
		alert("{ 나 } 는 사용불가입니다!");
		f.code_sbj.value="";
		f.code_sbj.focus();
		return false;
	}
	else if(!rownum) {
		alert("시작 행번호를 입력하세요!");
		f.code_row.focus();
		return false;
	}
	else if(!content) {
		alert("소스 코드 내용을 입력하세요!");
		f.source.focus();
		return false;
	}

	//content = content.replace(/</gi,'&lt;');
	var text = "\n["+code_type+"_code:"+rownum+"{"+title+"}]\n"+content+"\n[/"+code_type+"_code]";

	//opener.document.getElementById('memo').value = opener.document.getElementById('memo').value + text;
	insert_tag("\n["+title+"]",text,"\n");
	self.close();
	return true;
}
</script>
</head>
<body style="margin:10px">
<center>
<form action="./" method="get" onSubmit="return insertCode();" id="fo" name="frm">

<table border="0" width="800"><tr><td><h3>Code Highlighter</h3></td></tr></table>
<table cellspacing="0" class="tb_line" width="800">
<col width="100"></col><col width="700"></col>
<tr>
	<th>언어 종류</th>
	<td>
		<select id="code_type" name="code_type">
			<option value="applescript">AppleScript</option>
			<option value="as3">ActionScript3</option>
			<option value="bash">Bash/shell</option>
			<option value="cf">ColdFusion</option>					
			<option value="csharp">C#</option>
			<option value="cpp">C++/C</option>
			<option value="css">CSS</option>
			<option value="delphi">Delphi/Pascal</option>
			<option value="diff">Diff</option>
			<option value="erl">Erlang</option>
			<option value="groovy">Groovy</option>
			<option value="js">JavaScript</option>
			<option value="java">Java</option>
			<option value="jfx">JavaFX</option>
			<option value="perl">Perl</option>
			<option value="php">PHP</option>
			<option value="plain">Plain Text</option>					
			<option value="ps">PowerShell</option>
			<option value="py">Python</option>
			<option value="ruby">Ruby</option>
			<option value="scss">Sass</option>
			<option value="scala">Scala</option>
			<option value="sql">SQL</option>
			<option value="vb">Visual Basic</option>
			<option value="html" selected>HTML/XML</option>
		</select>
	</td>
</tr>
<tr>
	<th>타이틀(라벨)</th>
	<td>
		<input type="text" id="code_sbj" name="code_sbj" size="40" value="">
	</td>
</tr>
<tr>
	<th>시작 행번호</th>
	<td>
		<input type="text" id="code_row" name="code_row" name="code_row" size="10" value="1">
	</td>
</tr>
<tr>
	<th onclick=document.getElementById('source').rows=document.getElementById('source').rows+4 style=cursor:pointer>소스 기술 ▼</th>
	<td>
		<textarea id="source" name="source" cols="20" rows="20" style="width:100%" onkeydown='return doTab(event);'></textarea>
	</td>
</tr>
</table>

<input type="submit" value=" 추가 ">
<input type="button" onclick="window.close();return false;" value=" 닫기 ">

</form>
</center>
</body>
</html>
