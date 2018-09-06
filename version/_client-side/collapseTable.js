var CollapsedTable = function(prop) {

  this.table = prop.table;
  this.hiddenRowSelector = prop.hiddenRowSelector;
  this.control = prop.control;
  this.collapsed = false || prop.collapsed;
  this.tableHeight = 0;
  this.wrapperClass = 'collapse-table' || prop.wrapperClass;
  this.wrapperClassCollapsed = 'collapse-table--collapsed' || prop.wrapperClassCollapsed;
  this.tableCollapsedHeight = 0;

  this.init();

};

CollapsedTable.prototype.init = function() {

  this.calcTableHeight();
  this.calcCollapseHeight();
  this.addWrapper();

  this.action(this.collapsed);

  if(this.control){
    this.control.addEventListener('click', (e) => this.controlAction(e));
  }

};

CollapsedTable.prototype.toggle = function() {

  this.collapsed = !this.collapsed;
  this.action(this.collapsed);

};

CollapsedTable.prototype.action = function(collapse) {

  if(collapse) {
    this.hide();
  } else {
    this.show();
  }

};

CollapsedTable.prototype.addWrapper = function() {

  var wrapper = document.createElement('div');
  this.wrapper = wrapper;
  this.table.parentNode.insertBefore(wrapper,this.table);
  this.wrapper.classList.add(this.wrapperClass);
  this.wrapper.appendChild(this.table);

};

CollapsedTable.prototype.controlAction = function(event) {

  this.toggle();

};

CollapsedTable.prototype.calcTableHeight = function() {

  this.tableHeight = this.table.offsetHeight;

};

CollapsedTable.prototype.calcCollapseHeight = function() {

  let rows = this.table.querySelectorAll(this.hiddenRowSelector);
  let height = 0;
  if(rows) {
    rows.forEach(function(row) {
      height += row.offsetHeight;
    });
  }
  this.tableCollapsedHeight = height;

};

CollapsedTable.prototype.show = function() {

  this.wrapper.classList.remove(this.wrapperClassCollapsed);
  this.wrapper.style.height = this.tableHeight + 'px';

};

CollapsedTable.prototype.hide = function() {

  this.wrapper.classList.add(this.wrapperClassCollapsed);
  this.wrapper.style.height = this.tableHeight - this.tableCollapsedHeight + 'px'; 

};