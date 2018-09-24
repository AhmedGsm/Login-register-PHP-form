
<?PHP
class dj_limiter
{   
    public function __construct()
    {
    }
	
    public function display_Limiter($total_Elements)
    {
	$min_onPage=10;
	$max_onPage=50;
	
	if(isset($_GET['elems'])){
	$elements_onPage=htmlspecialchars($_GET['elems']);
	$elements_onPage=intval($elements_onPage);
		if($elements_onPage<1 OR !is_int( $elements_onPage ) ){
		$elements_onPage=$min_onPage;	
		}
		elseif($elements_onPage>$max_onPage){
		$elements_onPage=$max_onPage;	
		}
	}
	else{
	$elements_onPage=$min_onPage;	
	}
	$total_Pages=$total_Elements/$elements_onPage;
	$total_Pages= ceil(  $total_Pages );
	if($total_Elements<=$elements_onPage){
	$loop_Start=1;	
	$loop_End=$total_Elements;	
	}
	else
	{
		if(!isset($_GET['page'])   ){
		?>
		<meta HTTP-EQUIV="Refresh" Content="0; URL='?page=1&elems=10'">
		<?php 
		}
		else{
			$selected_Page=htmlspecialchars($_GET['page']);
			$selected_Page=intval($selected_Page);
			if($selected_Page<1 OR !is_int ( $selected_Page ) ){
			$selected_Page=1;	
			}
			elseif($selected_Page>$total_Pages){
			$selected_Page=$total_Pages;	
			}
			
			//$_SESSION['elems']=$_GET['elems'];
			 
			if($total_Pages<=7){
				for($pages_Counter=1;$pages_Counter<=$total_Pages;$pages_Counter++){
				echo "<a href='?page=$pages_Counter&elems=$elements_onPage'>$pages_Counter</a>" ;
				}
			}else{
			    $start=$selected_Page-2;
			    $end=$selected_Page+2;
				if($start<2){$start=2;$end=$start+4;};
				if($end>$total_Pages-1){$end=$total_Pages-1;$start=$end-4;};
				$previous_Page=$selected_Page-1;
				$next_Page=$selected_Page+1;
				//$previous_Page= max ($previous_Page, 1 );
				//$next_Page= min ($next_Page, $total_Pages );
				if($selected_Page>1 ){
				echo "<a title='Previous page' id='arrows'  href='?page=$previous_Page&elems=$elements_onPage'><</a>";
				}
				echo "<a href='?page=1&elems=$elements_onPage'>1</a>";
				//if()
				if($start>2)echo "<span id='points'>....</span>";
				for($pages_Counter=$start;$pages_Counter<=$end;$pages_Counter++){
				echo "<a href='?page=$pages_Counter&elems=$elements_onPage'>$pages_Counter</a>" ;
				}
				if($end<$total_Pages-1)echo "<span id='points'>....</span>";
				echo "<a href='?page=$total_Pages&elems=$elements_onPage'>$total_Pages</a>";	
				echo "<span id='delmt_text'>Page $selected_Page of $total_Pages</span>";
				if($selected_Page<$total_Pages ){
				echo "<a title='Next page' id='arrows'  href='?page=$next_Page&elems=$elements_onPage'>></a>";
				}
			}
			
			$loop_Start=(($selected_Page-1)*$elements_onPage)+1;
			$loop_End=$loop_Start+$elements_onPage-1;
			if($loop_End>$total_Elements) {
			$loop_End=$total_Elements;
			}
		}
	  }
	  $values['loop_start']=$loop_Start;
	  $values['loop_end']=$loop_End;
	  return $values;
    }
}

