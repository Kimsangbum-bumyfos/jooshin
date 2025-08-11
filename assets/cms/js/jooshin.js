jQuery(document).ready(function(){
	/*
		* 카테고리 _ 1뎁스
	*/
    $('.product_depth_1').change(function() {
        var code = $(this).val();
        defDepth_1(code);
    });
    /*
		* 카테고리 _ 2뎁스
    */
    $('.product_depth_2').change(function() {
        var code = $('.product_depth_2 option:selected').val();
        defDepth_2($('.product_depth_1').val(), code);
    });
});
/*
	* 카테고리 수정 페이지
	* 초기 셋팅(2뎁스, 3뎁스)
*/
function initDepth(depth_1, depth_2, depth_3){
	defDepth_1(depth_1);
	defDepth_2(depth_1, depth_2);
	initDepth_sub($('.product_depth_2 option'), depth_2);
	initDepth_sub($('.product_depth_3 option'), depth_3);
};
/*
	* DB 뎁스 선택 : @셀렉터(옵션), @뎁스 선택된 옵션 
*/
function initDepth_sub(select, matching){
	select.each(function(index, el) {
		if(select.eq(index).val() == matching)
			select.eq(index).attr('selected', true);
	});
};
/*
	* 뎁스 1 셋팅
*/
function defDepth_1(code){
	clearDepth($('.product_depth_2'));
    clearDepth($('.product_depth_3'));
    unLockDepth($('.product_depth_2'));
    lockDepth($('.product_depth_3'));
    switch (code) {
        case "계측장비":
            var depth_2 = ['전체'];
            break;
        case "스트레인게이지":
            var depth_2 = ['스트레인게이지', '악세사리'];
            break;
        case "계측센서":
            var depth_2 = ['하중계', '지진/가속도계', '변위계', '신율계', '토압계', '변형률계&무응력계', '압력계', '경사계', '온도계', '기타'];
            break;
        case "비디오게이지":
            var depth_2 = ['전체'];
            break;
        case "시험용치구":
            var depth_2 = ['전체'];
            break;
        case "제작품":
            var depth_2 = false;
            nonDepth($('.product_depth_2'));
            nonDepth($('.product_depth_3'));
            lockDepth($('.product_depth_2'));
            lockDepth($('.product_depth_3'));
            break;
    }
    addDepth(depth_2, $('.product_depth_2'));
};
/*
	* 뎁스 2셋팅
*/
function defDepth_2(depth_1, code){
	clearDepth($('.product_depth_3'));
    unLockDepth($('.product_depth_3'));

    switch (code) {
        case "전체": // 계측장비, 비디오게이지
            if(depth_1 == "계측장비")
                var depth_3 = ['JSH', 'TML', 'KYOWA', 'DEWESOFT', 'Campbell Scientific', '기타'];
            else if(depth_1 == "비디오게이지")
                var depth_3 = ['SOBRIETY', 'IMETRUM', '기타'];
            else if(depth_1 == "시험용치구")
                var depth_3 = ['Rubber Testing', 'Compression Testing', 'Tension Testing', 'Shear Testing', 'Fracture Toughness', 'Flexure Testing', 'Bond Testing', 'Adapters, Lock Rings, and Pins', '기타'];
            break;
        case "스트레인게이지":
            var depth_3 = ['TML', 'MM', 'KYOWA', 'SHOWA', '기타'];
            break;
        case "악세사리":
            var depth_3 = ['Adhesives', 'Coating Materials', 'Gauge installation Tape', 'Extension Cable', 'Spot welder', 'Strain Gauge Clamp', 'Strain Gauge Installation Tool kit', '기타'];
            break;
        case "하중계":
            var depth_3 = ['Compression', 'Tension/Compression', 'Tension', 'Component', 'Torque', '기타'];
            break;
        case "지진/가속도계":
            var depth_3 = ['Servo Type', 'Strain Gauge Type', 'ICP Type', 'Mems Type', '기타'];
            break;
        case "변위계":
            var depth_3 = ['Strain Gauge Type', 'Laser Type', 'Potentio Meter Type', '기타'];
            break;
        case "신율계":
            var depth_3 = ['Axial', 'High Temperature Axial', 'Clip-on Gauge', 'Deflectometers', 'Laser Extensometers', 'Calibrators', '기타'];
            break;
        case "토압계":
            var depth_3 = ['JSH', 'TML', 'KYOWA', 'SSK', '기타'];
            break;
        case "변형률계&무응력계":
            var depth_3 = ['JSH', 'TML', 'GEOKON', 'ROCTEST', '기타'];
            break;
        case "압력계":
            var depth_3 = ['JSH', 'TML', 'KYOWA', '기타'];
            break;
        case "경사계":
            var depth_3 = ['JSH', 'TML', '기타'];
            break;
        case "온도계":
            var depth_3 = ['Thermocouple', 'Thermistor', 'PT100', 'iButton', '기타'];
            break;
        case "기타":
            var depth_3 = ['균열계', '콤프레소미터', '풍향풍속계', '유량계', '철근계', '간극수압계', '수위계', '지중변위계', '침하계', '부식센서', '자동차센서', '기타'];
            break;
        default:
            // 제작품
            var depth_3 = false;
            nonDepth($('.product_depth_3'));
            lockDepth($('.product_depth_3'));
            break;
    }
    addDepth(depth_3, $('.product_depth_3'));
};
/*
	* 카테고리
	* addDepth: @셀렉터, @추가될곳 _ 옵션 추가
	* clearDepth : @셀렉터 _ 옵션 비우기
	* nonDepth : @셀렉터 _ 옵션 없음 표시
	* removeHiddenDepth : @셀렉터 _ 히든(선택하세요.) 삭제
	* lockDepth : @셀렉터 _ 비활성화
	* unLockDepth : @셀렉터 _ 활성화
*/
function addDepth(depth, targetItem){


    if(depth == false)
        return;

    for(var prop in depth){
        var item = '<option value="'+depth[prop]+'">'+depth[prop]+'</option>';
        targetItem.append(item);
    }
};
function clearDepth(select){
    select.empty();
    select.append('<option hidden selected value="">선택하세요.</option>');
};
function nonDepth(select){
    select.empty();
    select.append('<option hidden selected value="">없음</option>');
};
function removeHiddenDepth(select){
	select.find('option').eq(0).remove();
};
function lockDepth(depth){
    depth.attr('disabled', true);
};
function unLockDepth(depth){
    depth.removeAttr('disabled');
};
/*
    * 소스 정리 필요한 부분들
*/
/*
    * 멀티 이미지 업로드
    * fileUploadAction
    * handleImgsFilesSelect
    * deleteImageAction
    * deleteExImageAction
*/
/*
    * fileUploadAction() : @list _ 수정시 기존 리스트 
*/
function fileUploadAction(list, path){
    var data = new FormData();

    for(var i=0, len=sel_files.length; i<len; i++) {
        var name = "image_"+i;
        data.append(name, sel_files[i]);
    }
    data.append("image_count", sel_files.length);

    // if($('#imgs_wrap > a').length >5){
    //     alert("최대 추가 이미지 갯수는 5개입니다.");
    //     return;
    // }


    var xhr = new XMLHttpRequest();
    xhr.open("POST",base_url+"admin/"+path+"/img_chk");
    xhr.onload = function(e) {
        if(this.status == 200) {


            var str = e.currentTarget.responseText.substr(0, e.currentTarget.responseText.length -1);


            // 수정페이지
            if(ex_files != false) {
                if(str != ''){// 수정페이지
                    var str = str+','+list;
                }
                else{
                    var str = list;
                }
            }

            $('#img_list').val(str);
            si = false;
            // $("#write_action").submit();

        }
        else{
            alert("업로드에 실패했습니다.");
        }
    }
    xhr.send(data);
};

// 이미지 추가
function handleImgsFilesSelect(e){
    // sel_files = [];
    // $(".imgs_wrap").empty();

    var files = e.target.files;
    var fileArr = Array.prototype.slice.call(files);

    fileArr.forEach( function(f) {
        if(!f.type.match("image.*")){
            alert("이미지가 아닌 파일이 존재합니다.");
            return;
        }

        if(f.name.indexOf(',') != -1) {
            alert("파일명에서 ,(콤마)를 지워주세요.");
            return;
        }

        sel_files.push(f);

        var reader = new FileReader();

        reader.onload = function(e){
            var html = "<a href=\"javascript:void(0);\" class=\"th-img-cnt\" id=\"img_id_"+cnt+"\"><img src=\""+ e.target.result + "\" data-file='"+f.name+"' class='selProductFile'><span title=\"클릭시 삭제됩니다.\" onclick=\"deleteImageAction("+cnt+")\" class=\"ico-file-delete\"></span></a>";

            $("#imgs_wrap").append(html);
            cnt++;
        }
        reader.readAsDataURL(f);
    });
};

// 클릭시 이미지 삭제
function deleteImageAction(cnt){
    $('.th-img-cnt').each(function(index) {
        if($('.th-img-cnt').eq(index).attr('id') ==  'img_id_'+cnt){
            sel_files.splice(index, 1);
        }
    });

    $("#img_id_"+cnt).remove();
};

// 기존 이미지 삭제시
function deleteExImageAction(idx){

    $('.th-img-cnt-n').each(function(index) {
        if($('.th-img-cnt-n').eq(index).attr('id') ==  'img_id_'+idx){
            ex_files.splice(index, 1);
        }
    });
    $("#img_id_"+idx).remove();
};

/*
    * 멀티파일 핸들링
    *
    *

*/

// http 전송
function fileUploadAction_product(list, list_real){
    var data_file = new FormData();

    for(var i=0, len=f_sel_files.length; i<len; i++) {
        var name = "file_"+i;
        data_file.append(name, f_sel_files[i]);
    }
    data_file.append("file_count", f_sel_files.length);

    // if(f_sel_files.length < 1) {
    //     alert("한개이상의 파일을 선택해주세요.");
    //     return;
    // }

    if($('#files_wrap > p').length >5){
        alert("최대 파일 첨부 갯수는 5개입니다.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST",base_url+"admin/products/product/file_chk");
    xhr.onload = function(e) {
        if(this.status == 200) {
            var str = e.currentTarget.responseText.substr(0, e.currentTarget.responseText.length -1);
            // console.log(e.currentTarget.responseText);
            var law_name = '';
            var real_name = '';

            // alert('str  : ' + str);


            // 수정페이지
            if(f_ex_files != 'false') {
                // alert('ex_files != false');
                if(str != ''){// 수정페이지
                    // 파일 바뀜
                    // alert('str !=  파일 바뀜');

                    var temp = str.split(',');
                    // alert(temp);
                    // alert('temp.length : '+temp.length);


                    for(var i=0; i<temp.length; i++){
                        // alert('i : ' +i);
                        var j = temp[i].split('/');
                        

                        if(temp.length == 1){
                            // alert('for length = 0');
                            var j = temp[i].split('/');
                            law_name += j[0];
                            real_name += j[1];
                        }
                        else if(temp.length == parseInt(parseInt(i)+parseInt(1))){
                            //마지막루프 로 설정
                            // alert('for length = i-1');
                            var j = temp[i].split('/');
                            law_name += j[0];
                            real_name += j[1];
                        }
                        else{
                            // alert('for length = else');
                            var j = temp[i].split('/');
                            law_name += j[0]+',';
                            real_name += j[1]+',';
                        }
                    }

                    // alert('law_name : [list]' + law_name);
                    // alert('real_name : [list]' + real_name);

                    if(temp.length == 0){
                        if(list.length == 0){
                            var str = law_name;
                            var str_real = real_name;
                        }
                        else{
                            var str = law_name+','+list;
                            var str_real = real_name+','+list_real;
                        }
                    }
                    else{
                        if(list.length == 0){
                            var str = law_name.substr(0, law_name.length, -1);
                            var str_real = real_name.substr(0, real_name.length, -1);
                        }
                        else{
                            var str = law_name.substr(0, law_name.length, -1)+','+list;
                            var str_real = real_name.substr(0, real_name.length, -1)+','+list_real;
                        }

                    }

                    // alert('가공 str : ' + str);
                    // alert('가공 str_real : '+ str_real);

                } 
                else{
                    // 파일 안바뀜
                    // alert('else! 파일 안바뀜');
                    var str = list;
                    var str_real = list_real;
                    // alert('[수정페이지] : 파일 수정X 확인용도');
                    // alert(str);
                    // alert(str_real);
                }

                var result_law = str;
                var result_real = str_real;
            }
            else{
                // alert("쓰기 페이지");
                var temp = str.split(',');
            
                for(var i=0; i<temp.length; i++){
                    var j = temp[i].split('/');
                    law_name += j[0]+',';

                    if(j[1] != undefined || j[1] != 'undefined'){
                        real_name += j[1]+',';
                    }
                }

                var result_law = law_name.slice(0,-1);
                var result_real = real_name.slice(0,-1);
            }


            $('#file_list').val(result_law);
            $('#file_real_name').val(result_real);

            sf = false;

            // $("#write_action").submit();

        }
        else{
            alert("전송할 데이터가 없거나 네트워크에 문제가 발생했습니다.");
        }

    }
    xhr.send(data_file);

};

function handleFilesSelect(e){
    var files = e.target.files;
    var fileArr = Array.prototype.slice.call(files);

    fileArr.forEach( function(f) {
        // if(!f.type.match("")){
        //     alert("--파일이아니에요");
        //     return;
        // }

        if(f.name.indexOf(',') != -1) {
            alert("파일명에서 ,(콤마)를 지워주세요.");
            return;
        }

        f_sel_files.push(f);


        var reader = new FileReader();

        reader.onload = function(e){
            var html = "<p id=\"file_id_"+f_cnt+"\" class=\"th-file-cnt\"><a href=\"javascript:void(0);\" data-file='"+f.name+"' class='selFile'>"+f.name+"<span title=\"클릭시 삭제됩니다.\" onclick=\"deleteFileAction("+f_cnt+")\" class=\"ico-file-delete\"></span></a></p>";
            $("#files_wrap").append(html);
            f_cnt++;
        }
        reader.readAsDataURL(f);
    });
};

// 클릭시 파일 삭제
function deleteFileAction(cnt){
    $('.th-file-cnt').each(function(index) {
        if($('.th-file-cnt').eq(index).attr('id') ==  'file_id_'+cnt){
            f_sel_files.splice(index, 1);
        }
    });

    $("#file_id_"+cnt).remove();
};

// 기존 파일 삭제시
function deleteFileAction(idx){

    $('.th-file-cnt-n').each(function(index) {
        if($('.th-file-cnt-n').eq(index).attr('id') ==  'file_id_'+idx){
            f_ex_files.splice(index, 1);
            real_files.splice(index, 1);
        }
    });
    $("#file_id_"+idx).remove();
};


/*
    * [파일] 통합작성
*/




/*
    * 항목추가
    * 항목 추가 클릭 이벤트
    * 삭제 이벤트
*/

$(document).on('click', '#add_cell', function(){
    cell.add();
});

$(document).on('click', '.btn-cell.remove', function(){
    cell.remove($(this));
});

var cell = {
    /*
        * 클릭시 항목 생성
    */
    add:function(){

        $('#form_cell_key').val()

        var key = $('#form_cell_key').val();
        var value = $('#form_cell_value').val();


        if(key == '' || value == ''){
            showModal('#popupModal');
            $("#popup-msg").text("항목을 입력해 주세요.");
            return;
        }

        cell.createdElm(key,value);
        cell.resetVal();
    },
    /*
        * 항목생성
    */
    createdElm:function(key, value){
        var cell_item = '<div class="cell-item">\
                            <div class="col-25 fl-l">\
                                <input type="text"  name="" id="" class="form add-cell-key add" value="'+key+'" placeholder="항목명을 입력해주세요">\
                            </div>\
                            <div class="cell-with-btn">\
                                <textarea name="" id="" class="add-cell-value add" cols="" rows="">'+value+'</textarea>\
                            </div>\
                            <div class="cell-btn">\
                                <button type="button" id="" class="btn-cell remove btn typeA-darkgray">삭제</button>\
                            </div>\
                        </div>';
        // $('#add_input_wrap').prepend(cell_item);
        $('#ctl_cell').before(cell_item);
    },
    /*
        * 입력 input reset
    */
    resetVal:function(){
        $('#form_cell_key').val('');
        $('#form_cell_value').val('');
    },
    /*
        * 클릭시 항목 삭제
    */
    remove:function(tg){
        tg.parent().parent('.cell-item').remove();
    },
    /*
        * 추가항목 Key - Value Json
    */
    save:function(){
        var dataArr = new Array();
        $('.add-cell-key.add').each(function(index) {
            var dataObj = new Object();

            dataObj.key = $('.add-cell-key.add').eq(index).val();
            dataObj.val = $('.add-cell-value.add').eq(index).val();

            dataArr.push(dataObj);
        });

        // json 형태의 문자열로 만든다.
        var jsonData = JSON.stringify(dataArr);

        $('#key_value').val(jsonData);
    },
    /*
        * 수정 페이지에서 로드
    */
    load:function(json){
        $('#key_value').val(JSON.stringify(json));

        if(json !== undefined || json !== '[]')
            for(var prop in json)
                cell.createdElm(json[prop].key, json[prop].val);
        else
            console.log('undefined or [] json');
    },
};