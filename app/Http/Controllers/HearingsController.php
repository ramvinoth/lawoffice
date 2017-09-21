<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Auth;
use Session;
use App\Models\Hearing;
use Illuminate\Http\Request;
use App\Util\CommonUtil;
use App\Mail\Reminder;
use Mail;
class HearingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Hearing::get();
        return response()->json($data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $event = Hearing::initialize();
        return response()
            ->json([
                'form' => $event,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $hearing_array = $request->all();
        
        $hearing = Hearing::create($hearing_array);
        
        return response()->json([
            'saved' => true,
            'hearing' => $hearing,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Hearing::where([['diary.id','=',$id]])->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hearing = Hearing::findOrFail($id);

        return response()
            ->json([
                'form' => $hearing,
                'option' => []
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hearing $hearing)
    {
        //
        $hearing_array = $request->all();
        $hearing_array['updated_at'] = (new DateTime())->getTimeStamp()."000";
        $status = $hearing->update($hearing_array);
        Session::flash('success', 'Hearing updated.');
        return response()
            ->json([
                'updated' => $status
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hearing $hearing)
    {
        //
        $status = $hearing->delete();
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    
    public function getHearings(Request $request)
    {
        $id = $request->id;
        $data = Hearing::where([['case_id','=',$id]])->get();
        $commonUtil = new CommonUtil();
        foreach($data as $key => $dataObj){
            $data[$key]['date'] = $commonUtil->convertLongToDate($data[$key]['date'], 'd-m-Y');
        }
        return response()->json($data);
    }
    
    public function deleteHearings($id){
        $status = Hearing::whereId($id)->delete();
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    /*
    public function showCaseHearings(Request $request)
    {
        $id = $request->id;
        $data = Hearing::where([['case_id','=',$id]])->get();
        return response()->json($data);
    }
    */
    public function getTomorrowsHearingsList()
    {
        //Mail::to(\App\Models\User::find(1))->send(new Reminder());
        
        $sdate = new DateTime('tomorrow');
        $edate = new DateTime('tomorrow');
        
        //date_modify($sdate,'+2 day');
        //date_modify($edate,'+2 day');
        // First day of this month
        $sdate = $sdate->setTime(00, 00, 00);
        $edate = $edate->setTime(23, 59, 59);
        
        $isMonthView = true;
        $data = $this->getHearingsArr($sdate, $edate, $isMonthView);
        
        return response()->json($data);
        
    }
    
    public function getHearingsList(Request $request)
    {
        //Mail::to(\App\Models\User::find(1))->send(new Reminder());
        $stDate = $request->sdate;
        $sdate = new DateTime('now');
        $edate = new DateTime('now');
        if($stDate != 'undefined' && $stDate != ''){
            $sdate = new DateTime($stDate);
            $edate = clone $sdate;
        }
        
        // First day of this month
        $sdate = $sdate->modify('first day of this month');
        $edate = $edate->modify('last day of this month');
        
        $isMonthView = true;
        
        date_modify($sdate,'-10 day');
        date_modify($edate,'+10 day');
        
        $data = $this->getHearingsArr($sdate, $edate, $isMonthView);
        
        return response()->json($data);
        
    }
    public function getHearingsDO($sdate, $edate, $isMonthView){
        $sd = $sdate->getTimestamp()."000";
        $ed = $edate->getTimestamp()."000";
        
        $query = Hearing::select('diary.*');
        
        if($isMonthView){
            $query->where([
                ['diary.posted','>=',$sd],
                ['diary.posted','<=',$ed]
            ]);
        }else{
            $query->where('diary.posted','>=',$sd)->orWhere('diary.posted','<=',$ed);
        }
        
        $data = $query->get();
        return $data;
    }
    public function getHearingsArr($sdate, $edate, $isMonthView){
        $sd = $sdate->getTimestamp()."000";
        $ed = $edate->getTimestamp()."000";
        
        $query = Hearing::select('diary.id','diary.case_no as title','diary.posted as start', 'diary.case_id');
        
        if($isMonthView){
            $query->where([
                ['diary.posted','>=',$sd],
                ['diary.posted','<=',$ed]
            ]);
        }else{
            $query->where('diary.posted','>=',$sd)->orWhere('diary.posted','<=',$ed);
        }
        
        $data = $query->get();
        $commonUtil = new CommonUtil();
        foreach ($data as $key => $event){
            $data[$key]['start'] = $commonUtil->convertLongToDate($data[$key]['start'], 'Y-m-d');
            $data[$key]['end'] = $data[$key]['start'];
            $data[$key]['id'] = $data[$key]['id'];
            $data[$key]['case_id'] = $data[$key]['case_id'];
            $data[$key]['type'] = 'hearings';
            $data[$key]['borderColor'] = '#00a65a';
            $data[$key]['name'] = 'Hearing';
            $data[$key]['backgroundColor'] = '#00a65a';
        }
        return $data;
    }
    
    public function getUpcomingHearing(){
        
        $sdate = new DateTime('now');
        $edate = new DateTime('now');
        
        date_modify($edate,'+15 day');
        
        $isMonthView = true;
        
        $data = $this->getHearingsDO($sdate, $edate, $isMonthView);
        //print_r($data);
        return $data;
    }
    
    public function getTomorrowsHearingCount(){
        $sdate = new DateTime('tomorrow');
        $edate = new DateTime('tomorrow');
        date_modify($edate,'+1 day');
        
        $sd = $sdate->getTimestamp()."000";
        $ed = $edate->getTimestamp()."000";
        
        $isMonthView = true;
        $data = Hearing::where([
                ['diary.posted','>=',$sd],
                ['diary.posted','<=',$ed]
            ])->count();
        return $data;
    }
    
    public function send($email){
        \Log::info("Sending Email... to ".$email);
        Mail::to($email)->send(new Reminder);
        if( count(Mail::failures()) > 0 ) {
           echo "There was one or more failures. They were: <br />";
           foreach(Mail::failures as $email_address) {
               echo " - $email_address <br />";
            }
        } else {
            echo "No errors, all sent successfully!";
        }
    }
    
    public function sendmail(){
        $sname = "MADURA TRAVELS";
        $mail_from = "ramvinoth37@gmail.com";
        $mail_to = "vinothvallavan6@gmail.com";
        $mail_body = "dummy body";
        $mail_subject = "Enquiry";
        $mail_header = "From: ".$sname." <".$mail_from.">\r\n";

        //$mail_from = 'offers@viya.biz';
        //$mail_to = $email;
        //$mail_subject = 'Offer code.';

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: ".$sname." <".$mail_from.">\r\n";

        $sendmail = mail($mail_to, $mail_subject, $mail_body, $headers);
        if($sendmail == 1)
        {
            $msg = '<script type="text/javascript">
                  window.onload = function () { alert("Mail Sent"); }
        </script>';
        }
        else
        {
            $msg =  "0";
        }
        return $msg;
    }
}
?>