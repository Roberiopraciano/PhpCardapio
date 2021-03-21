              /* MSFmultiSelect v1.00
 * Developed by Jagadeesan S
 * jagadeesanjd11@gamil.coms
 * https://minisuperfiles.blogspot.com
 */
 class MSFmultiSelect{
  constructor(select, settings={}) {
    this.select = select;
    this.settings = settings;
    this.defultSettings={
      
      
      appendTo:'body',
      className:'form-control'
    }
    this.select.multiple=true;
    this.select.style.display='none';
    this.create();
  }
  create(){
    var div=document.createElement('DIV');
    div.className='msf_multiselect_container';
    this.id='msf_multiselect_'+(document.querySelectorAll('.msf_multiselect_container').length+1);
    div.id=this.id;
    var ul=document.createElement('UL'); 
    ul.className='msf_multiselect';
    var textarea=document.createElement('textarea'); textarea.readOnly=true;
    textarea.style.height=(this.settings.height) ? this.settings.height+'px' : this.defultSettings.height+'px';
    textarea.style.width=(this.settings.width) ? this.settings.width+'px' : this.defultSettings.width+'px';
    textarea.className=(this.settings.className) ? this.settings.className : this.defultSettings.className;
    var self=this,display="";
    if(this.settings.selectAll){
      var label=document.createElement('label');
      var li=document.createElement('LI');
      var input=document.createElement('input');
      input.type='checkbox';
      input.disabled=(this.settings.readOnly) ? true: false;
      input.addEventListener('click',function(){
        this.parentElement.className=(this.checked) ? 'active' : '';
        self.selectAll(this.checked);
      });
      var caption=document.createTextNode(' SELECIONAR TUDO');
      li.appendChild(input);
      li.appendChild(caption);
      label.appendChild(li);
      ul.appendChild(label);
    }
    for(var i=0,len=this.select.children.length; i<len; i++){
      var label=document.createElement('label');
      var li=document.createElement('LI');
      var input=document.createElement('input');
      input.type='checkbox';
      input.disabled=(this.settings.readOnly) ? true: false;
      input.value=this.select.children[i].value;
      var caption=document.createTextNode(this.select.children[i].innerText);
      input.addEventListener('click',function(){
        if(this.checked){
          self.setValue([this.value]);
        }else{
          self.removeValue([this.value]);
        }
        if(typeof self.settings.onChange=='function'){
          self.settings.onChange(this.checked,this.value,self);
        }
      });
      li.appendChild(input);
      li.appendChild(caption);
      if(this.select.children[i].selected){
        li.className='active';
        input.checked=true;
        display+=(display) ? ", "+this.select.children[i].innerText : this.select.children[i].innerText;
      }else{
        li.className='';
        input.checked=false;
      }
      label.appendChild(li);
      ul.appendChild(label);
    }
    textarea.value=display;
    this.logger=textarea;
    div.appendChild(textarea);
    var addTarget;
    if(this.settings.appendTo){
      addTarget=document.querySelector(this.settings.appendTo);
    }else{
      addTarget=document.querySelector(this.defultSettings.appendTo);
    }
    //set width
    ul.style.width=(this.settings.width) ? this.settings.width+2+'px' : this.defultSettings.width+2+'px';
    ul.style.display='none';
    div.appendChild(ul);
    this.list=ul;
    this.container=div;
    addTarget.appendChild(div);
    // add event
    document.addEventListener('click',function(event){
      var isClickInside=self.container.contains(event.target);
      if(!isClickInside){
        self.list.style.display='none';
      }
    });
    this.logger.addEventListener('click',function(){
      if(self.list.style.display=='none'){
        self.list.style.display='';
      }else{
        self.list.style.display='none';
      }
    });
}
setValue(selected=[]){
  if(selected.length){
    for(var i=0; i<this.select.children.length; i++){
      for(var j=0; j<selected.length; j++){
        if(this.select.children[i].value==selected[j]){
          this.select.children[i].selected=true;
          var sync=(this.settings.selectAll) ? (i+1) : i;
          this.list.children[sync].children[0].children[0].checked=true;
            this.list.children[sync].children[0].className='active'; //need to change;
            break;
        }
    }
}
this.log();
}
}
removeValue(selected=[]){
  if(selected.length){
    for(var i=0; i<this.select.children.length; i++){
      for(var j=0; j<selected.length; j++){
        if(this.select.children[i].value==selected[j]){
          this.select.children[i].selected=false;
          var sync=(this.settings.selectAll) ? (i+1) : i;
          this.list.children[sync].children[0].children[0].checked=false;
            this.list.children[sync].children[0].className=''; //need to change;
            break;
        }
    }
}
this.log();
}
}
log(){
  var display="";
  for(var i=0; i<this.select.children.length; i++){
    if(this.select.children[i].selected){
      display+=(display) ? ", "+this.select.children[i].innerText : this.select.children[i].innerText;
    }
  }
  this.logger.value=display;
}
getData(){
  var data=[];
  for(var i=0; i<this.select.children.length; i++){
    if(this.select.children[i].selected){
      data.push(this.select.children[i].value);
    }
  }
  return data;
}
selectAll(is=false){
  var data=[];
  for(var i=0; i<this.select.children.length; i++){
    data.push(this.select.children[i].value);
  }
  if(is){
    this.setValue(data);
  }else{
    this.removeValue(data);
  }
}
loadSource(data=[]){
  if(data.length!=0){
    this.select.innerHTML='';
    for(var i=0; i<data.length; i++){
      var option=document.createElement('OPTION');
      option.value=data[i].value;
      option.innerHTML=data[i].caption;
      option.selected=data[i].selected;
      this.select.appendChild(option);
    }
    this.reload();
  }
}
getSource(){
  var data=[];
  for(var i=0; i<this.select.children.length; i++){
    data.push({value:this.select.children[i].value,caption:this.select.children[i].innerText,selected:this.select.children[i].selected});
  }
  return data;
}
reload(){
  this.container.remove();
  this.create();
}
}

