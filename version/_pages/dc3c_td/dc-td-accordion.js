document.addEventListener('DOMContentLoaded', function() {
	var items = document.querySelectorAll('.dc-td-accordion');
	var itemsCount = 0;
	var breakPoint = '768';	
	
	function accordionCollapseAll(){
		for (var i = 0, len = itemsCount; i < len; i++) {
			items[i].classList.remove("dc-td-accordion--open");
			items[i].querySelector('.dc-td-accordion__collapse-container').classList.remove("dc-td-accordion__collapse-container--open");
			items[i].querySelector('.dc-td-accordion__collapse-container').style.height = 0;
		}
	}
	
	function accordionCollapseSelf(item){
		item.classList.remove("dc-td-accordion--open");
		item.querySelector('.dc-td-accordion__collapse-container').classList.remove("dc-td-accordion__collapse-container--open");
		item.querySelector('.dc-td-accordion__collapse-container').style.height = 0;
	}
	
	function accordionOpen(item){		
		if(item.classList.contains("dc-td-accordion--hard-open") && window.innerWidth >= breakPoint){
			return;
		}		
		if(item.classList.contains("dc-td-accordion--open")){			
			accordionCollapseSelf(item);
			return;
		}		
		accordionCollapseAll();
		item.classList.add("dc-td-accordion--open");
		item.querySelector('.dc-td-accordion__collapse-container').style.height = item.querySelector('.dc-td-accordion__collapse-container').firstElementChild.offsetHeight + 'px';
		setTimeout(function(){item.querySelector('.dc-td-accordion__collapse-container').classList.add("dc-td-accordion__collapse-container--open");}, 500);
	}
	
	function accordionResize(){
		for (var i = 0, len = itemsCount; i < len; i++) {			
			if(items[i].classList.contains("dc-td-accordion--open")){	
				items[i].querySelector('.dc-td-accordion__collapse-container').style.height = items[i].querySelector('.dc-td-accordion__collapse-container').firstElementChild.offsetHeight + 'px';
				return;
			}
		}
	}
		
	function accordionIni(){
		if(items.length > 0){
			itemsCount = items.length;
			for (var i = 0, len = itemsCount; i < len; i++) {
				items[i].querySelector('.dc-td-accordion__collapse-controll').addEventListener('click', function(e) {
					accordionOpen(this.parentElement);
				});;
			}
			
			window.addEventListener('resize', function(){
				accordionResize();
			});
			
			accordionOpen(items[0]);
		}		
	}
	
	accordionIni();
	
	
});