<!DOCTYPE html>

<html>
<head>
<title>Availability</title>


<style type="text/css">
  body {

  background-color:#f5ca5c;
  padding: 10px;
}

   ul {
     font-family: Arial;
     list-style-type: none;
   margin: 0;
   position: absolute;
   top: 0;
   left:0;
   width: 98%;
   overflow: hidden;
     background-color: #333;
   }

li {
  float: right;
}

.logo {
  float: left;
padding: 4px 5px;
 }

li a {
display: block;
color: white;
  text-align: center;
padding: 14px 20px;
  text-decoration: none;
}





 .tdborder {background-color: #464540;}
 .tdclosed {background-color: #9b936f;}
 .tdselect {background-color: #94d509;}
 .tdopen {background-color: #ffffff;}
 .tdheader {background-color: #464540;}
 .tdtitle {background-color: #e2ddc0;}
	    /*  BODY{color: #000000;
		background: #e2ddc0;}*/
  TD {font: 11px ms sans serif,geneva,arial,helvetica;
  color: #000000;}
  INPUT {font-size: 11px;
  font-family: courier new,courier,monospace;}
  SELECT {font-size: 11px;
  font-family: courier new,courier,monospace;}
  
  FONT.textclosed {color: #ffffff;}
  FONT.textheader {color: #ffffff;
  text-decoration: none;}
  
  A.textclosed{color: #ffffff;}
  A.textopen {color: #000000;
  text-decoration: none;}
  A:visited {color: #000000;
  text-decoration: none;}



</style>
</head>

<body>
<ul>
  <div class="logo">
  <img src="https://s16.postimg.org/ckbr6pov9/THISSS.png" height="50px">
  </div>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="home.php">MY DASHBOARD</a></li>
</ul>


									
  function js_calendarday(num,day)
{
  document.forms[0].calDay.value = num + ':' + day + '-';
  document.forms[0].submit();
}
function js_flipcalendar(btn)
{
  document.forms[0].calDay.value = btn;
  document.forms[0].submit();
}
function js_gotocalendar(btn)
{
  document.forms[0].calMnth.value = btn;
  document.forms[0].calDay.value = 'goto';
  document.forms[0].submit();
}
function js_bookit(btn)
{
  document.forms[0].calDay.value = btn;
  document.forms[0].submit();
}
function js_clicked(btn)
{
  document.forms[0].clicked.value = btn;
  document.forms[0].submit();
}
//-->
        </SCRIPT>
	
	
	<FORM METHOD="POST">
  <INPUT TYPE=HIDDEN NAME="calDay" VALUE="7:we-" SIZE=5>
  <INPUT TYPE=HIDDEN NAME="booktime" VALUE="09:20am" SIZE=5>
  <INPUT TYPE=HIDDEN NAME="clicked" VALUE="" SIZE=5>
  <INPUT TYPE=HIDDEN NAME="calMnth" VALUE="2016:12" SIZE=5>
  
  <DIV ALIGN="LEFT">
  <TABLE BORDER=0 CELLPADDING=0 CELLSPACING=7>
  
  <TR>
  
  <TD COLSPAN=2>
  <TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
  <TR>
  <TD>
  <H4>Appointment Scheduler</H4>
  </TD>
  <TD>
  
  </TD>
  </TR>
  </TABLE>
  </TD></TR>
  
  <TR><TD COLSPAN=2>
  <TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0>
  <TR>
  <TD>
  Please choose the dates and times you would like to make available for students.
  </TD>
  </TR>
  </TABLE>
  </TD></TR>
  
  <TR><TD VALIGN=TOP ALIGN=CENTER>
  <TABLE CLASS=tdborder BORDER=0 CELLPADDING=9 CELLSPACING=2
  WIDTH=518>
  <TR><TD CLASS=tdheader ALIGN=CENTER COLSPAN=7>
  
  <TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
  <TR><TD ALIGN=LEFT>
  <FONT CLASS=textheader>
  <BIG><B>&nbsp;</B></BIG>
  
  </FONT>
  </TD><TD ALIGN=CENTER COLSPAN=5>
  
  <FONT CLASS=textheader>
  <BIG><B>December 2016</B></BIG>
  
  </FONT>
  </TD><TD ALIGN=RIGHT>
  
  <FONT CLASS=textheader>
  <BIG><B><A HREF="javascript:js_flipcalendar('plus');">
  <FONT CLASS=textheader>[ + ]</FONT></A>
  </B></BIG>
  
  </FONT>
  </TD></TR>
  </TABLE>
  </TD></TR>
  <TR>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Sunday</TD>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Monday</TD>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Tuesday</TD>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Wednesday</TD>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Thursday</TD>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Friday</TD>
  <TD CLASS=tdtitle ALIGN=CENTER WIDTH=74>Saturday</TD>
  </TR>
  <TR>
  <TD CLASS=tdclosed>&nbsp;</TD>
  <TD CLASS=tdclosed>&nbsp;</TD>
  <TD CLASS=tdclosed>&nbsp;</TD>
  <TD CLASS=tdclosed>&nbsp;</TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('1','th');">
  <BIG>1</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('2','fr');">
  <BIG>2</BIG></A>
  </TD>
  <TD CLASS=tdclosed><BIG><FONT CLASS=textclosed>3</FONT></BIG>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('4','su');">
  <BIG>4</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('5','mo');">
  <BIG>5</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('6','tu');">
  <BIG>6</BIG></A>
  </TD>
  <TD CLASS=tdselect><A CLASS=textopen HREF="javascript:js_calendarday('7','we');">
  <BIG>7</BIG></A>
  </TD>
<TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('8','th');">
  <BIG>8</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('9','fr');">
  <BIG>9</BIG></A>
  </TD>
  <TD CLASS=tdclosed><BIG><FONT CLASS=textclosed>10</FONT></BIG>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('11','su');">
  <BIG>11</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('12','mo');">
  <BIG>12</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('13','tu');">
  <BIG>13</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('14','we');">
  <BIG>14</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('15','th');">
  <BIG>15</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('16','fr');">
  <BIG>16</BIG></A>
</TD>
  <TD CLASS=tdclosed><BIG><FONT CLASS=textclosed>17</FONT></BIG>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('18','su');">
  <BIG>18</BIG></A>
</TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('19','mo');">
  <BIG>19</BIG></A>
</TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('20','tu');">
  <BIG>20</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('21','we');">
  <BIG>21</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('22','th');">
  <BIG>22</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('23','fr');">
  <BIG>23</BIG></A>
</TD>
  <TD CLASS=tdclosed><BIG><FONT CLASS=textclosed>24</FONT></BIG>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('25','su');">
  <BIG>25</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('26','mo');">
  <BIG>26</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('27','tu');">
  <BIG>27</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('28','we');">
  <BIG>28</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('29','th');">
  <BIG>29</BIG></A>
  </TD>
  <TD CLASS=tdopen><A CLASS=textopen HREF="javascript:js_calendarday('30','fr');">
  <BIG>30</BIG></A>
  </TD>
  <TD CLASS=tdclosed><BIG><FONT CLASS=textclosed>31</FONT></BIG>
  </TD>
  </TR>
  </TABLE>
  <BR/>&nbsp;<BR/><BR/>&nbsp;<BR/><BR/><BR/><TABLE BORDER=0 CELLPADDING=7 CELLSPACING=2 CLASS=tdborder>
  
  <TR><TD ALIGN=CENTER CLASS=tdheader COLSPAN=2>
  
  <FONT COLOR="#ffffff">Details of Appointment</FONT>
  </TR>
  
  <TR><TD ALIGN=RIGHT CLASS=tdtitle>
  
  For the following time :
  
  </TD>
  <TD CLASS=tdselect WIDTH=81 ALIGN=CENTER>
  09:20am</TD>
  </TR>
  
  <TR><TD COLSPAN=2 CLASS=tdopen ALIGN=CENTER>
  
  <TABLE BORDER=0 CELLPADDING=5 CELLSPACING=4 WIDTH="100%">
  <TR>
  <TD COLSPAN=2>
  This will be added to your availability.
  </TD>
  </TR>
  <TR>
  <TD COLSPAN=2>
  Please Enter :
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdtitle ALIGN=RIGHT>
  Name :
  </TD>
  <TD>
  <INPUT TYPE=TEXT NAME="POST_name" VALUE="" SIZE=25>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdtitle ALIGN=RIGHT>
  Email :
  </TD>
  <TD>
  <INPUT TYPE=TEXT NAME="POST_email" VALUE="" SIZE=25>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdtitle ALIGN=RIGHT>
  Phone Number :
  </TD>
  <TD>
  <INPUT TYPE=TEXT NAME="POST_phone" VALUE="" SIZE=15>
  </TD>
  </TR>
  <TR>
  <TD CLASS=tdtitle ALIGN=RIGHT>
  Reason for appointment :
  </TD>
  <TD>
  <INPUT TYPE=TEXT NAME="POST_reason" VALUE="" SIZE=25>
  </TD>
  </TR>
  
  </TABLE>
  <BR/>
  
  <INPUT TYPE=BUTTON VALUE="Reserve" NAME="reserveBtn" 
  ONCLICK="javascript:js_clicked('reserve');">
  </TD></TR>
  
  </TABLE>
</TD><TD VALIGN=TOP WIDTH="100%" ALIGN=CENTER>
  <TABLE CLASS=tdborder BORDER=1 CELLPADDING=3 CELLSPACING=2 WIDTH=143>
  
  <TR><TD ALIGN=CENTER CLASS=tdheader HEIGHT=33>
  
  <FONT COLOR=#ffffff>
  <BIG><B>7</B></BIG> Wednesday
  </FONT>
  
  </TD></TR>
  
  <TR><TD ALIGN=CENTER CLASS=tdselect HEIGHT=29>
  Open 09:00am - 05:00pm<BR/>at 10 minutes intervals</TD></TR>
      <TR><TD ALIGN=RIGHT CLASS=tdopen>
      <A CLASS=textopen HREF="javascript:js_bookit('7:we-09:00am');">
      09:00am</A>
      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
	      <A CLASS=textopen HREF="javascript:js_bookit('7:we-09:10am');">
	      09:10am</A>
	      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdselect>
		      <A CLASS=textopen HREF="javascript:js_bookit('7:we-09:20am');">
		      09:20am</A>
		      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
			      <A CLASS=textopen HREF="javascript:js_bookit('7:we-09:30am');">
			      09:30am</A>
			      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
				      <A CLASS=textopen HREF="javascript:js_bookit('7:we-09:40am');">
				      09:40am</A>
				      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
					      <A CLASS=textopen HREF="javascript:js_bookit('7:we-09:50am');">
					      09:50am</A>
					      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
						      <A CLASS=textopen HREF="javascript:js_bookit('7:we-10:00am');">
						      10:00am</A>
						      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
							      <A CLASS=textopen HREF="javascript:js_bookit('7:we-10:10am');">
							      10:10am</A>
							      &nbsp;&nbsp;
</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
								      <A CLASS=textopen HREF="javascript:js_bookit('7:we-10:20am');">
								      10:20am</A>
								      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
									      <A CLASS=textopen HREF="javascript:js_bookit('7:we-10:30am');">
									      10:30am</A>
									      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
										      <A CLASS=textopen HREF="javascript:js_bookit('7:we-10:40am');">
										      10:40am</A>
										      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
											      <A CLASS=textopen HREF="javascript:js_bookit('7:we-10:50am');">
											      10:50am</A>
											      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
												      <A CLASS=textopen HREF="javascript:js_bookit('7:we-11:00am');">
												      11:00am</A>
												      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													      <A CLASS=textopen HREF="javascript:js_bookit('7:we-11:10am');">
													      11:10am</A>
													      &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-11:20am');">
													 11:20am</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-11:30am');">
													 11:30am</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-11:40am');">
													 11:40am</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-11:50am');">
													 11:50am</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-12:00pm');">
													 12:00pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-12:10pm');">
													 12:10pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-12:20pm');">
													 12:20pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-12:30pm');">
													 12:30pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-12:40pm');">
													 12:40pm</A>
													 &nbsp;&nbsp;
													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-12:50pm');">
													 12:50pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-01:00pm');">
													 01:00pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-01:10pm');">
													 01:10pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-01:20pm');">
													 01:20pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-01:30pm');">
													 01:30pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-01:40pm');">
													 01:40pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-01:50pm');">
													 01:50pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
														 <A CLASS=textopen HREF="javascript:js_bookit('7:we-02:00pm');">
														 02:00pm</A>
														 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
															 <A CLASS=textopen HREF="javascript:js_bookit('7:we-02:10pm');">
															 02:10pm</A>
															 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
																 <A CLASS=textopen HREF="javascript:js_bookit('7:we-02:20pm');">
																 02:20pm</A>
																 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
																	 <A CLASS=textopen HREF="javascript:js_bookit('7:we-02:30pm');">
																	 02:30pm</A>
																	 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
																		 <A CLASS=textopen HREF="javascript:js_bookit('7:we-02:40pm');">
																		 02:40pm</A>
																		 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
																			 <A CLASS=textopen HREF="javascript:js_bookit('7:we-02:50pm');">
																			 02:50pm</A>
																			 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
																				 <A CLASS=textopen HREF="javascript:js_bookit('7:we-03:00pm');">
																				 03:00pm</A>
																				 &nbsp;&nbsp;

</TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
																					 <A CLASS=textopen HREF="javascript:js_bookit('7:we-03:10pm');">
																					 03:10pm</A>
																					 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-03:20pm');">
													 03:20pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-03:30pm');">
													 03:30pm</A>
													 &nbsp;&nbsp;
													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-03:40pm');">
													 03:40pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-03:50pm');">
													 03:50pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-04:00pm');">
													 04:00pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-04:10pm');">
													 04:10pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-04:20pm');">
													 04:20pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-04:30pm');">
													 04:30pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-04:40pm');">
													 04:40pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
<TR><TD ALIGN=RIGHT CLASS=tdopen>
													 <A CLASS=textopen HREF="javascript:js_bookit('7:we-04:50pm');">
													 04:50pm</A>
													 &nbsp;&nbsp;

													 </TD></TR>
</TABLE>
</TD>

													 </TR>
<TR><TD COLSPAN=2 ALIGN=CENTER><TABLE BORDER=0 CELLPADDING=5 CELLSPACING=2 WIDTH=100%>

        </TABLE>
</TD></TR>
</TABLE>
</DIV>

													 </FORM>

													 </BODY>

													 </HTML>
