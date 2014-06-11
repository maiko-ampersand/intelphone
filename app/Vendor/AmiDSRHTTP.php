<?php
/**
* AmiVoice DSR HTTPサーバの簡易音声認識モード実行の為のクラス
*
* @author atsushi sasaki (Advanced-Media, Inc.) <a_sasaki@advanced-media.co.jp>
* @since PHP 5.3
* @version 1.0.0
*/
class AmiDSRHTTP {   
	private $url_ ;
	private $errorMessage_;
	private $resultData_ ;
	private $grammarName_;
	
	/**
	* コンストラクタ
	*
	* @param string $AmiVoiceHTTPServerURL 接続先AmiVoice DSR HTTPサーバ
	* @param string $grammarName 利用するグラマファイルのURL（ディクテーション認識対応のHTTPサーバを指定している場合は未指定）
	*/
	function __construct($AmiVoiceHTTPServerURL, $grammarName = ""){
		$this->url_ = $AmiVoiceHTTPServerURL;
		$this->grammarName_ = $grammarName;
	}

	/**
	* 音声認識を行う
	* 入力可能な音声データは30秒です。30秒以上の音声は打ち切られます。
	* @param binary $buff WAV形式の音声データ 
	* @return mixed 
	 * 認識成功時：かな漢字交じりの認識結果文字列
	 * 認識失敗時：false
	*/
    public function speechRecognition($buff){
        $options = array('http' => array(
            'header' => "Content-Type: application/octet-stream",
            'method' => 'POST',
            'content' => $buff,
        ));
        $org_timeout = ini_get('default_socket_timeout');
        // 390秒以上かかったらタイムアウトにする
        ini_set('default_socket_timeout', 390);
		$url = $this->url_;
		if($this->grammarName_ != ""){
			$url = $url . "?d=" . $this->grammarName_;				
		}
		
        $return = file_get_contents($url, false, stream_context_create($options));		
        // 設定を戻す
        ini_set('default_socket_timeout', $org_timeout);
		
		$this->resultData_ = $return;
	    $written = $this->parseAmiResult($return); 
        
        if($written == ""){
			$this->errorMessage_ = "音声認識サーバから無効なフォーマットを受信しました。";
            return false;
        }
        return $written;
    }
	

	/**
	 * 最後に発生したエラーメッセージを取得する
	 * @return string エラーメッセージ 
	 */
	public function getLastErrorMessage(){
		return $this->errorMessage_;
	}

	
	/**
	 * AmiVoice DSR HTTPサーバより受信した認識結果を編集せずに返す
	 * @return string  <表記>:<信頼度0～1>:<発話開始オフセットmsec>:<発話終了オフセットmsec>:<よみがな>|<表記>:<信頼度0～1>:<発話開始オフセットmsec>:<発話終了オフセットmsec>:<よみがな>|・・・
	 */
	public function getRawData(){
		return $this->resultData_;
	}
    
 
	
    private function parseAmiResult($resultDataWritten){
        $tokens = explode ("|", $resultDataWritten);
        $written = array();
        for($i = 0; $i < count($tokens); $i++){
            $items = explode (":",$tokens[$i]);
            $first = explode (" ",$items[0]);
            $top = explode("\003",$first[0]);
            $top = explode("\002",$top[0]);
            $top[0] = str_replace("_"," ",$top[0]);
            $written[] = str_replace("<->","",$top[0]); 
        }
        return $written;
    }    
}
?>
