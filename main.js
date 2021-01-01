(function (window, document) {

        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            mode: {name: "javascript", json: true},
            lineNumbers: true,
            lineWrapping: true,
matchBrackets:true,
            extraKeys: {
                "Ctrl-Q": function (cm) {
                    cm.foldCode(cm.getCursor());
                },
"F11": function(cm) { cm.setOption("fullScreen", !cm.getOption("fullScreen")); }, "Esc": function(cm) { if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false); }
            },
            foldGutter: true,
            gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
            foldOptions: {
                widget: (from, to) => {
                    var count = undefined;

                    // Get open / close token
                    var startToken = '{', endToken = '}';
                    var prevLine = window.editor.getLine(from.line);
                    if (prevLine.lastIndexOf('[') > prevLine.lastIndexOf('{')) {
                        startToken = '[', endToken = ']';
                    }

                    // Get json content
                    var internal = window.editor.getRange(from, to);
                    var toParse = startToken + internal + endToken;

                    // Get key count
                    try {
                        var parsed = JSON.parse(toParse);
                        count = Object.keys(parsed).length;
                    } catch (e) {
                    }

                    return count ? `\u21A4${count}\u21A6` : '\u2194';
                }
            }
        });
        var input = document.getElementById("select");

        function selectTheme() {
            var theme = input.options[input.selectedIndex].textContent;
            editor.setOption("theme", theme);
            location.hash = "#" + theme;
        }

        var choice = (location.hash && location.hash.slice(1)) ||
            (document.location.search &&
                decodeURIComponent(document.location.search.slice(1)));
        if (choice) {
            input.value = choice;
            editor.setOption("theme", choice);
        }
        CodeMirror.on(window, "hashchange", function () {
            var theme = location.hash.slice(1);
            if (theme) {
                input.value = theme;
                selectTheme();
            }
        });
;
debug= false;// выключить везде
function _alert(message, required){
	required=required||false;// принудительно для одного
if(debug ||required)
	alert(message);
}

editor.setOption("fullScreen", true);
a= document.getElementById('src');
url = '/trash/i3_formatted.json (1)';
url = '/trash/news (2).json';
a.href= url;
a.innerHTML=url;
      
fetch(url)
            .then(response => response.text())
            .then(obj => {
                debugger;
_alert('248');
                try {
	obj = obj1=JSON.parse(obj);
	_alert('251');
                    test = [];
sort= false;
if(sort){
                    ok = obj.data.data.sort(function (a, b) {

                        if (('comment' in a) && ('comment' in b) && ('num' in a.comment) && ('num' in b.comment) && ('smiles' in a.comment.num) && ('smiles' in b.comment.num)) {
                            test.push({smiles: a.comment.num.smiles, text: a.comment.text});
                            return b.comment.num.smiles - a.comment.num.smiles;
                        } else return null;
                    });}
//_alert (JSON.stringify(test));
              
                console.log(test);
    //value = JSON.stringify(obj, null, ' ');
  value = JSON.stringify(obj, null, ' ');
               // value = JSON.stringify(test.sort((a,b)=>{return b.smiles - a.smiles;}), null, ' ');
                //	hljs.highlightBlock(pre);
_alert('268\n'+ value);
                editor.setValue(value);
ul = document.querySelector("#ul");
types={0:{},bytype:{}};

obj.data.data.forEach(function (v,i,arr){
	keys = Object.keys(v) ;
	types['0'][keys[0]]=(typeof types['0'][keys[0]]=="undefined")?1: types['0'][keys[0]]+1; 
types['bytype'][v.type]= ((typeof types['bytype'][v.type]== "undefined")?1: types['bytype'][v.type]+1);
li = document.createElement('li' ) ;
if('comment' in v){
	if('id' in v.comment){
		li.setAttribute('id', v.comment.id);
	}
	}
//li.innerHTML='<b>'+v['comment']['num']['smiles']+'</b> <code>'+v['comment']['text']+'</code>';
item(v,li,ul);

//li.innerHTML=item(v);
//ul.appendChild(li);
})
function Comment(json) {
let that = this;
that.el = null;
that.ul='ul';
that.ul_replies ='replies';
Object.assign(that, json);
//добавляет li в ul 
that.add=function (ul){
this.ul = ul||document.getElementById(this.ul);

let str,li; 
str='<b>'+this['num']['smiles']+'</b> <code>'+this.text+'</code>';
li = document.createElement('li' ) ;
li.innerHTML=str;
if('id' in this){
		li.setAttribute('id', this.id);
	}
this.ul.appendChild(li);

}
that.reply=function(){
let ul ;
		ul  = this.el.getElementsByClassName(this.ul_replies)[0];
		if(!ul) 
		{	ul = document.createElement('ul' ) ;
			ul.setAttribute('class', his.ul_replies);
			this.el.appendChild(ul);
			}
			alert(ul);
			this.add(ul);
	
}
that.init=function (){
	if(!this.exists())
							this.add();
							else {
								if(this.is_reply){
		this.reply();
							}
							alert('not esists\n'+JSON.stringify(this));
							}
}
that .exists= function (){
this.el = document.getElementById(this.id);

return this.el ; 
}
that.init();
}
function item(v, li,ul){
	if(typeof v['type']== 'undefuned')
		return '??';
		else 
			type = v['type'];
		if(type=='comment')
			{
						
				if('comment' in v){	
									c=new Comment (v.comment); 
				//	str='<b>'+v['comment']['num']['smiles']+'</b> <code>'+v['comment']['text']+'</code>';
		//	li.innerHTML=str;
//ul.appendChild(li);
			}
			}
		if(type=='reply_for_comment')
			{
				c=new Comment (v.comment, type); 
				if('comment' in v){
					if('id' in v.comment)
					{	//document.write(JSON.stringify(v.comment));
						//c=new Comment (v.comment); 
						
			/*	 newli = document.getElementById(v.comment.id);
			//	debug=	JSON.stringify({'newli':newli, 'v.comment.id':v.comment.id, "c":c, "exists":c.exists()}, null, ' ');
						alert(debug,true);
						if(newli)
							li = lewli;*/
					}
			//	str='<b>'+v['comment']['num']['smiles']+'</b> <code>'+v['comment']['text']+'</code>';
		if('reply' in v){
			
		//		str+='<ul><li><b>'+v['reply']['num']['smiles']+'</b> <code>'+v['reply']['text']+'</code></li></ul>';
			}
		//	return str;
				}
		}
		return type;
}
_alert(JSON.stringify(types,null,' '));
  } catch(e) {
	_alert('parse error \n'+e['message']+ e['trace'],true);
	editor.setValue(obj)
	
                }
            })
            .catch(function (error) {
	_alert('Request failed'+ error, true);
                console.error('Request failed', error);
            });
})(window, document);