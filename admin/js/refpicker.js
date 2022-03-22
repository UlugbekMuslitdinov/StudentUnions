//Responsible for the little team list popups - TODO: Generalize this so the alliance popup isn't a copypaste job
$.fn.autoTeams = function(){
	var s=$(this);
	s.keypress(function(e) {
		if(e.which == 13) {
			var input=$(this).val().toLowerCase();
			var result=[];
			if(cTeams.length){
				for(i in cTeams){
					cTeams[i].matchFactor=(cTeams[i].number.toLowerCase().indexOf(input)*2)+(cTeams[i].name.toLowerCase().indexOf(input)*2)+(cTeams[i].id.toString().indexOf(input))+5;
					if(cTeams[i].matchFactor){
						result.push(cTeams[i]);
					}
					result.sort(function(a,b){return a.matchFactor-b.matchFactor;});
					if(result.length){
						$(this).val(result[0].id).blur();
						$("#autocomp").hide();
					}
				}
			}
		}
	});
	s.on('input focusin',function(){
		var input=s.val().toLowerCase();
		var coords=s.offset();
		var result=[];
		if(cTeams.length){
			for(i in cTeams){
				cTeams[i].matchFactor=(cTeams[i].number.toLowerCase().indexOf(input)*2)+(cTeams[i].name.toLowerCase().indexOf(input)*2)+(cTeams[i].id.toString().indexOf(input))+5;
				if(cTeams[i].matchFactor){
					result.push(cTeams[i]);
				}
			}
			result.sort(function(a,b){return a.matchFactor-b.matchFactor;});
			coords.top=Math.floor(coords.top)+30;
			coords.left=Math.floor(coords.left);
			var t=$("#autocomp").empty().show();
			t.offset(coords);
			if(result.length){
				t.append('<tr class="row-h"><td class="col-pre">ID</td><td class="col-5">Number</td><td class="col-35">Name</td></tr>');
				for(i in result){
					var r=result[i];
					if(i<30){
						$('<tr class="row-a'+(i<1 ? ' first' : '')+'">\
							<td class="col-pre">'+r.id+'</td>\
							<td class="col-5">'+r.number+'</td>\
							<td class="col-35">'+r.name+'</td>\
						</tr>')
						.appendTo(t)
						.data("tid",r.id)
						.mousedown(function(){
							s.val($.data(this,'tid'));
						});
					}
				}
			}else{
				t.append('<tr class="row-h"><td>No matching teams</td></tr>');
			}
		}
	});
	s.focusout(function(){
		$("#autocomp").hide();
	});
	return this;
}