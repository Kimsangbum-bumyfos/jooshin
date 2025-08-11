// & trans to n
if(pDepth_1 == '시험용치구&지그')
    pDepth_1 = '시험용치구n지그';

if(pDepth_2 == '변형률계&무응력계')
    pDepth_2 = '변형률계n무응력계';

if(pDepth_1 == '')
    pDepth_1 = '계측장비';

// var pDepth_2 = trans_param(2, pDepth_2);
var pDepth_3 = trans_param(3, pDepth_3);

function trans_param(depth, depth_name){
    var lower = depth_name.toLowerCase();
    var n_depth_name='';
    switch (depth) {
        case 1:
            break;
        case 2:
            // switch (lower) {
            //     // 계측장비
            //     case "jsm":
            //         n_depth_name = 'JSM';
            //         break;
            //     case "tml":
            //         n_depth_name = 'TML';
            //         break;
            //     case "kyowa":
            //         n_depth_name = 'KYOWA';
            //         break;
            //     case "dewesoft":
            //         n_depth_name = 'DEWESOFT';
            //         break;
            //     case "campbell scientific":
            //         n_depth_name = 'Campbell Scientific';
            //         break;
            //     default:
            //         var n_depth_name=depth_name;
            //         break;
            // }
            break;
        case 3:
            switch (lower) {
                // 계측장비
                case "jsm":
                    n_depth_name = 'JSM';
                    break;
                case "dewesoft":
                    n_depth_name = 'DEWESOFT';
                    break;
                case "campbell scientific":
                    n_depth_name = 'Campbell Scientific';
                    break;
                // 스트레인게이지
                case "tml":
                    n_depth_name = 'TML';
                    break;
                case "mm":
                    n_depth_name = 'MM';
                    break;
                // 로드셀과 겹치는데 대소문자가 다름
                // case "kyowa":
                //     n_depth_name = 'Kyowa';
                //     break;
                case "showa":
                    n_depth_name = 'SHOWA';
                    break;
                // 악세사리
                case "gauge installation tape":
                    n_depth_name = 'Gauge installation Tape';
                    break;
                case "extension cable":
                    n_depth_name = 'Extension Cable';
                    break;
                case "spot welder":
                    n_depth_name = 'Spot welder';
                    break;
                case "strain gauge clamp":
                    n_depth_name = 'Strain Gauge Clamp';
                    break;
                case "strain gauge installation tool kit":
                    n_depth_name = 'Strain Gauge Installation Tool kit';
                    break;
                // 로드셀
                case "novatech":
                    n_depth_name = 'Novatech';
                    break;
                case "ssk":
                    n_depth_name = 'SSK';
                    break;
                // 가속도계
                case "servo type":
                    n_depth_name = 'Servo Type';
                    break;
                case "strain gauge type":
                    n_depth_name = 'Strain Gauge Type';
                    break;
                case "icp type":
                    n_depth_name = 'ICP Type';
                    break;
                case "mems type":
                    n_depth_name = 'Mems Type';
                    break;
                // 변위계
                case "laser type":
                    n_depth_name = 'Laser Type';
                    break;
                case "potentio meter type":
                    n_depth_name = 'Potentio Meter Type';
                    break;
                // 신율계
                case "epsilon":
                    n_depth_name = 'Epsilon';
                    break;
                // 변형률계
                case "geokon":
                    n_depth_name = 'GEOKON';
                    break;
                case "roctest":
                    n_depth_name = 'ROCTEST';
                    break;
                // 풍향풍속계
                case "rm young":
                    n_depth_name = 'RM YOUNG';
                    break;
                // 유량계
                case "nuritech":
                    n_depth_name = 'nuritech';
                    break;
                // 온도계
                case "thermocouple":
                    n_depth_name = 'Thermocouple';
                    break;
                // 기타
                case "pore pressure transducer":
                    n_depth_name = 'Pore Pressure Transducer';
                    break;
                case "crack displacement transducers":
                    n_depth_name = 'Crack Displacement Transducers';
                    break;
                case "water level transducer":
                    n_depth_name = 'Water Level Transducer';
                    break;
                case "rod extensometers":
                    n_depth_name = 'Rod extensometers';
                    break;
                case "reinforcing bar meter":
                    n_depth_name = 'Reinforcing Bar Meter';
                    break;
                case "settlement transducer":
                    n_depth_name = 'Settlement Transducer';
                    break;
                case "cone pressuremeter":
                    n_depth_name = 'Cone Pressuremeter';
                    break;
                case "torque transducer":
                    n_depth_name = 'Torque Transducer';
                    break;
                case "automotive measuring system":
                    n_depth_name = 'Automotive Measuring System';
                    break;
                default:
                    var n_depth_name=depth_name;
                    break;
            }
            break;
        default:
            var n_depth_name=depth_name;
            break;
    }

    return n_depth_name;
};