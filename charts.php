<?php
 include('queries.php');
$where =$_POST['where'];
if($where == 'monthly_exchange_comparison' )
{   
       $fastsum = 0;
       $exchange_comparison = array(['Month', 'Number of exchanges made']);
       $row1 = mysqli_fetch_array($exchangesMonth1);
       $row2 = mysqli_fetch_array($exchangesMonth2);
       $row3 = mysqli_fetch_array($exchangesMonth3);
       $row4 = mysqli_fetch_array($exchangesMonth4);    
       $total1 = ['4 months ago',$row1['sum']];
       $total2 = ['3 months ago',$row2['sum']];
       $total3 = ['2 months ago',$row3['sum']];
       $total4 = ['Last 1 month',$row4['sum']]; 
        array_push($exchange_comparison, $total1);
        array_push($exchange_comparison, $total2);
        array_push($exchange_comparison, $total3);
        array_push($exchange_comparison, $total4);
       $array = json_encode($exchange_comparison);
        echo $array;
}  
else if($where == 'newsignups' )
{   
  $signupsTotal = array();
  $row1 = mysqli_fetch_array($signupsWk1);
  $total1 = $row1['sum'];
  $Total1 = $total1;
  $row2 = mysqli_fetch_array($signupsWk2);
  $total2 = $row2['sum'];
  $Total2 = $total2;
  $row3 = mysqli_fetch_array($signupsWk3);
  $total3 = $row3['sum'];
  $Total3 = $total3;
  $row4 = mysqli_fetch_array($signupsWk4);
  $total4 = $row4['sum'];
  $Total4 = $total4;
  array_push($signupsTotal, $Total1);
  array_push($signupsTotal, $Total2);
  array_push($signupsTotal, $Total3);
  array_push($signupsTotal, $Total4);
 $array = json_encode($signupsTotal);
  echo $array;
}
else if($where == 'demandedCounties' )
{   
       $demandsum = 0;
       $mostDemandedCounties = [];
        foreach($demandedCounties as $row){
        $county = $row['county'];
        $total = $row['sum'];
        $demandsum += $total;
        $resultArray = array($county, $total);
        array_push($mostDemandedCounties, $resultArray);
        }
        $totalsum = $requests_no['sum'];
        $other = $totalsum - $demandsum;
        array_push($mostDemandedCounties,['Other',$other]);
       $array = json_encode($mostDemandedCounties);
        echo $array;
}  
else if($where == 'tiersComparison' )
{   
       $tierList = array(['Tier', 'Number of homes']);
       $row1 = mysqli_fetch_array($tier1number);
       $row2 = mysqli_fetch_array($tier2number);
       $row3 = mysqli_fetch_array($tier3number);
       $row4 = mysqli_fetch_array($tier4number);
       $row5 = mysqli_fetch_array($tier5number);    
       $total1 = ['Tier 1',$row1['sum']];
       $total2 = ['Tier 2',$row2['sum']];
       $total3 = ['Tier 3',$row3['sum']];
       $total4 = ['Tier 4',$row4['sum']]; 
       $total5 = ['Tier 5',$row5['sum']]; 
        array_push($tierList, $total1);
        array_push($tierList, $total2);
        array_push($tierList, $total3);
        array_push($tierList, $total4);
        array_push($tierList, $total5);
       $array = json_encode($tierList);
        echo $array;
}
else if($where == 'customerType' )
{   
       $typeList = array(['Customer Type', 'Number']);
        foreach($customerTypeNumbers as $row){
        $type = $row['type'];
        $count = $row['count'];
        $resultArray = array($type, $count);
        array_push($typeList, $resultArray);
        }
       $array = json_encode($typeList);
        echo $array;
}
else if($where == 'salesTotal')
{   
       $salesTotal = array();
        $row1 = mysqli_fetch_array($salesWk1);
        $total1 = $row1['sum'];
        $Total1 = $total1;
        $row2 = mysqli_fetch_array($salesWk2);
        $total2 = $row2['sum'];
        $Total2 = $total2;
        $row3 = mysqli_fetch_array($salesWk3);
        $total3 = $row3['sum'];
        $Total3 = $total3;
        $row4 = mysqli_fetch_array($salesWk4);
        $total4 = $row4['sum'];
        $Total4 = $total4;
        array_push($salesTotal, $Total1);
        array_push($salesTotal, $Total2);
        array_push($salesTotal, $Total3);
        array_push($salesTotal, $Total4);
       $array = json_encode($salesTotal);
        echo $array;
}
else if($where == 'profit/loss')
{   
       $values = array();
        $row1 = mysqli_fetch_array($monthSalesValue);
        $sales = $row1['sum'];
        $row2 = mysqli_fetch_array($monthIncomeValue);
        $income = $row2['sum'];
        $row3 = mysqli_fetch_array($monthExpenseValue);
        $expenses = $row3['sum'];
        $row4 = mysqli_fetch_array($salariesTotal);
        $salaries = $row4['salaries'];
        $expenses = $expenses + $salaries;
        $gross = $income  - $sales;
        $net = $gross - $expenses ;
        array_push($values, $gross);
        array_push($values, $expenses);
        array_push($values, $net);
       $array = json_encode($values);
        echo $array;
}
else if($where == 'tierDemand')
{   
       $tierRequests = array();
        $row1 = mysqli_fetch_array($tier1Wk1);
        $row2 = mysqli_fetch_array($tier1Wk2);
        $row3 = mysqli_fetch_array($tier1Wk3);
        $row4 = mysqli_fetch_array($tier1Wk4);
        $row5 = mysqli_fetch_array($tier2Wk1);
        $row6 = mysqli_fetch_array($tier2Wk2);
        $row7 = mysqli_fetch_array($tier2Wk3);
        $row8 = mysqli_fetch_array($tier2Wk4);
        $row9 = mysqli_fetch_array($tier3Wk1);
        $row10 = mysqli_fetch_array($tier3Wk2);
        $row11 = mysqli_fetch_array($tier3Wk3);
        $row12 = mysqli_fetch_array($tier3Wk4);
        $row13 = mysqli_fetch_array($tier4Wk1);
        $row14 = mysqli_fetch_array($tier4Wk2);
        $row15 = mysqli_fetch_array($tier4Wk3);
        $row16 = mysqli_fetch_array($tier4Wk4);
        $row17 = mysqli_fetch_array($tier5Wk1);
        $row18 = mysqli_fetch_array($tier5Wk2);
        $row19 = mysqli_fetch_array($tier5Wk3);
        $row20 = mysqli_fetch_array($tier5Wk4);
        array_push($tierRequests, $row1['sum']);
        array_push($tierRequests, $row2['sum']);
        array_push($tierRequests, $row3['sum']);
        array_push($tierRequests, $row4['sum']);
        array_push($tierRequests, $row5['sum']);
        array_push($tierRequests, $row6['sum']);
        array_push($tierRequests, $row7['sum']);
        array_push($tierRequests, $row8['sum']);
        array_push($tierRequests, $row9['sum']);
        array_push($tierRequests, $row10['sum']);
        array_push($tierRequests, $row11['sum']);
        array_push($tierRequests, $row12['sum']);
        array_push($tierRequests, $row13['sum']);
        array_push($tierRequests, $row14['sum']);
        array_push($tierRequests, $row15['sum']);
        array_push($tierRequests, $row16['sum']);
        array_push($tierRequests, $row17['sum']);
        array_push($tierRequests, $row18['sum']);
        array_push($tierRequests, $row19['sum']);
        array_push($tierRequests, $row20['sum']);
       $array = json_encode($tierRequests);
        echo $array;
}
else if($where == 'salescomparison' )
{  
    $titleComparison = array('Day');
    $fiveDaysAgo = date('d/m/Y', strtotime("-5 days"));
    $fourDaysAgo = date('d/m/Y', strtotime("-4 days"));
    $threeDaysAgo = date('d/m/Y', strtotime("-3 days"));
    $twoDaysAgo = date('d/m/Y', strtotime("-2 days"));
    $yesterday = "Yesterday";
    $today = "Today";
    $salesComparisonFiveDaysAgo = array($fiveDaysAgo);
    $salesComparisonFourDaysAgo = array($fourDaysAgo);
    $salesComparisonThreeDaysAgo = array($threeDaysAgo);
    $salesComparisonTwoDaysAgo = array($twoDaysAgo);
    $salesComparisonYesterday = array($yesterday);
    $salesComparisonToday = array($today);
    foreach($distributionComparisonFiveDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($titleComparison,$name);
      array_push($salesComparisonFiveDaysAgo,$sum);
    }
    foreach($distributionComparisonFourDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonFourDaysAgo,$sum);
    }
    foreach($distributionComparisonThreeDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonThreeDaysAgo,$sum);
    }
    foreach($distributionComparisonTwoDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonTwoDaysAgo,$sum);
    }
    foreach($distributionComparisonYesterday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonYesterday,$sum);
    }
    foreach($distributionComparisonToday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonToday,$sum);
    }
    array_push($titleComparison,'Average');
    $arrayTitle = json_encode($titleComparison);
     $row = mysqli_fetch_array($distributionTotalToday);
    $todaySum = $row['count'];
    $row1 = mysqli_fetch_array($distributionTotalYesterday);
    $yesterdaySum = $row1['count'];
    $row2 = mysqli_fetch_array($distributionTotalTwoDaysAgo);
    $twoDaysAgoSum = $row2['count'];
    $row3 = mysqli_fetch_array($distributionTotalThreeDaysAgo);
    $threeDaysAgoSum = $row3['count'];
    $row4 = mysqli_fetch_array($distributionTotalFourDaysAgo);
    $fourDaysAgoSum = $row4['count'];
    array_push($salesComparisonThreeDaysAgo,$threeDaysAgoSum);
    $row5 = mysqli_fetch_array($distributionTotalFiveDaysAgo);
    $fiveDaysAgoSum = $row5['count'];
    array_push($salesComparisonToday,$todaySum);
    array_push($salesComparisonYesterday,$yesterdaySum);
    array_push($salesComparisonTwoDaysAgo,$twoDaysAgoSum);
    array_push($salesComparisonThreeDaysAgo,$threeDaysAgoSum);
    array_push($salesComparisonFourDaysAgo,$fourDaysAgoSum);
    array_push($salesComparisonFiveDaysAgo,$fiveDaysAgoSum);
    $finalArray = array($arrayTitle,$salesComparisonFiveDaysAgo,$salesComparisonFourDaysAgo,$salesComparisonThreeDaysAgo,$salesComparisonTwoDaysAgo,$salesComparisonYesterday,$salesComparisonToday);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison1' )
{  
    $salesNamesToday = array();
    $salesFiguresToday = array();
    foreach($distributionComparisonToday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNamesToday,$name);
      array_push($salesFiguresToday,$sum);
    }
    $finalArray = array($salesNamesToday,$salesFiguresToday);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison2' )
{  
    $salesNamesYesterday = array();
    $salesFiguresYesterday = array();
    foreach($distributionComparisonYesterday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNamesYesterday,$name);
      array_push($salesFiguresYesterday,$sum);
    }
    $finalArray = array($salesNamesYesterday,$salesFiguresYesterday);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison3' )
{  
    $twoDaysAgo = date('d/m', strtotime("-2 days"));
    $salesNames_2 = array();
    $salesFigures_2 = array();
    foreach($distributionComparisonTwoDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNames_2,$name);
      array_push($salesFigures_2,$sum);
    }
    $finalArray = array($salesNames_2,$salesFigures_2);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison4' )
{  
    $threeDaysAgo = date('d/m', strtotime("-3 days"));
    $salesNames_3 = array('Deliverer');
    $salesFigures_3 = array($threeDaysAgo); 
    foreach($distributionComparisonThreeDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNames_3,$name);
      array_push($salesFigures_3,$sum);

    }
    array_push($salesNames_3,"{ role: 'annotation' }");
    array_push($salesFigures_3,"''");
    $finalArray = array($salesNames_3,$salesFigures_3);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison5' )
{  
    $salesNames_4 = array();
    $salesFigures_4 = array();
    $fourDaysAgo = date('d/m', strtotime("-4 days"));
    foreach($distributionComparisonFourDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNames_4,$name);
      array_push($salesFigures_4,$sum);
    }
    $finalArray = array($fourDaysAgo,$salesNames_4,$salesFigures_4);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison6' )
{  
    
    $salesNames_5 = array();
    $salesFigures_5 = array();
    $fiveDaysAgo = date('d/m', strtotime("-5 days"));
    foreach($distributionComparisonFiveDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
       array_push($salesNames_5,$name);
      array_push($salesFigures_5,$sum);
    }
    $finalArray = array($fiveDaysAgo,$salesNames_5,$salesFigures_5);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'homesRegistration' )
{    
        $row1 = mysqli_fetch_array($newHomesWk2);
        $row2 = mysqli_fetch_array($newHomesWk2);
        $row3 = mysqli_fetch_array($newHomesWk3);
        $row4 = mysqli_fetch_array($newHomesWk4);    
        $total1 = $row1['sum'];
        $total2 = $row2['sum'];
        $total3 = $row3['sum'];
        $total4 = $row4['sum'];
        $homesRegistration = array();
        array_push($homesRegistration, $total1);
        array_push($homesRegistration, $total2);
        array_push($homesRegistration, $total3);
        array_push($homesRegistration, $total4);
       $array = json_encode($homesRegistration);
        echo $array;
}
?>