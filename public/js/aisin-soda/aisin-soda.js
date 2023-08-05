
//Global Variable
var resource;
//var api="http://172.18.3.7/soda/public"; //API to load data
// var api="http://172.18.10.22/soda/public";
var start=17; //variable for starting time in scheduller
var last_id=0; //variable for last id of log
var flag=false; //variable for determain refresh or not
var shift="satu"; //variable for re-layout timeline => satu,dua,tiga
var reload_flag=false;



//Function here

//Loading data at first time
function loadData(){
	$.ajax({
		//url : "http://172.18.10.22/soda/public/active/all",
		//url : "api.php",
		url : api+"/api/active",
		type: "get",
		dataType:'JSON',
		success:function(a){
			for(var i=0;i<a.length;i++){
				if(a[i].status!="Completed"){
					var ori=a[i].color;
					a[i].color="white;border:2px solid "+ori+";"
					a[i].textColor=ori;
				}
			}
			resource=a;
			init(a);
		},
		error:function(xhr, Status, err){
			//alert("error pada "+xhr);
			}
		}
	);
}

//Refresh the datasource
function Refresh(){
	//alert('Refresh');
	$.ajax({
		// url : "http://172.18.10.22/soda/public/active/all",
		//url : "api.php",
		url : api+"/api/active",
		type: "get",
		dataType:'JSON',
		success:function(a){
			for(var i=0;i<a.length;i++){
				if(a[i].status!="Completed"){
					var ori=a[i].color;
					a[i].color="white;border:2px solid "+ori+";"
					a[i].textColor=ori;
				}
			}
			resource=a;
			//Update Schedullernya
			scheduler.clearAll();
			scheduler.setCurrentView();
			scheduler.parse(a,"json");

		},
		error:function(xhr, Status, err){
			//alert("error pada "+xhr);
			}
		}
	);
}


//Init the timeline
function init(data) {
	scheduler.locale.labels.timeline_tab = "Timeline";
	scheduler.locale.labels.section_custom="Section";
	scheduler.config.xml_date="%Y-%m-%d %H:%i";
	scheduler.config.readonly = true;
	scheduler.config.mark_now = true;
	scheduler.xy.nav_height = 0;

	//Create Section (Y Axis)
	var sections=[
	{key:1, label:"Downloading"},
	{key:2, label:"Pulling"},
	{key:3, label:"Staging"},
	{key:4, label:"Waiting"},
	{key:5, label:"Loading"},
	{key:6, label:"Delivery"}
	];

	//Configuration of Timeline view
	var s= GetShift();
	var val=12;
	if(s=="satu"){
		val=12;
	} if (s=="dua"){
		val=28;
	} else{
		val=44;
	}

	dhtmlXTooltip.config.className = 'dhtmlXTooltip tooltip';
	dhtmlXTooltip.config.timeout_to_display = 50;
	dhtmlXTooltip.config.delta_x = 15;
	dhtmlXTooltip.config.delta_y = -20;

	scheduler.templates.tooltip_text = function(start,end,event) {
		if(event.reason!=null){
			return "Delay karena: "+event.reason;
		}
	}

	scheduler.createTimelineView({
		name:	"timeline",
		x_unit:	"minute",
		x_date:	"%H:%i",
		x_step:	30,
		x_size: 17,
		x_start: val,
		x_length:16,
		y_unit:	sections,
		y_property:	"section_id",
		render:"bar",

	});

	//Initialize
	scheduler.init('scheduler_here',new Date(),"timeline");
	scheduler.parse(data,"json");
}

//Ceck the Log, if any changes found, set true
function CekLastId(){
	$.ajax({
		url : api+"/api/log/latest",
		type: "get",
		dataType:'JSON',
		success:function(result){
			if(last_id!=result){
				last_id=result;
				flag=true;
			}
		},
		error:function(xhr, Status, err){
			//alert("error pada "+xhr);
		}
	});
}

//Get Initial Value of shift
function GetShift(){
	var date=new Date();
	var hours = date.getHours();
	var shift;
	if(hours>=6 && hours <14){
		shift="satu";
	} if(hours>=14 && hours <22){
		shift="dua";
	} if(hours>=22 && hours <6){
		shift="tiga";
	}
	return shift;
}

//Load the initial news
LoadNews = function(){
	var news="";
	$.ajax({
		url : api+"/api/incomplete",
		type: "get",
		dataType:'JSON',
		success:function(a){
			for(var i=0;i<a.length;i++){
				news=" "+news+a[i].customer+" "+a[i].phase+" "+a[i].text+" is "+a[i].status;
				if(a[i].reason!=null){
					news= news + " ("+ a[i].reason+" ) **** ";
				}else{
					news= news + " **** ";
				}
			}
			//Update News
			$('#news').html(news);
		},
		error:function(xhr, Status, err){
			//alert("error pada "+xhr);
			}
		}
	);
}