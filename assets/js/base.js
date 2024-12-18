jQuery(function () {
  jQuery("c-gnav").click(function () {
    jQuery("c-gnav li.selected").removeClass("selected");
    jQuery(this).addClass("selected");
  });
});

// トップへ戻るボタン
("use strict");

{
  // データ取得
  // DOM取得
  // pagetopボタン
  const pageTop = document.querySelector(".pagetop");

  // console.log(pageTop);

  // トップへ戻るボタンを表示する位置のsection
  const secGreen = document.querySelector(".to-top");
  // console.log(secGreen);

  // ビューポートの高さ
  const vh = window.innerHeight;
  // console.log(vh);

  // イベント付加
  window.addEventListener("scroll", function () {
    // スクロール量
    const scroll = window.pageYOffset;
    // console.log(scroll);

    // 要素の位置までの数値
    const targetDistance = secGreen.getBoundingClientRect().top;
    // console.log(targetDistance);

    // 要素までの絶対位置
    const targetPosition = scroll + targetDistance - vh;

    // スクロール量がtargetPositionの位置を超えたら
    if (targetPosition < scroll) {
      pageTop.classList.add("fadeIn");
    } else {
      pageTop.classList.remove("fadeIn");
    }
  });
}

// トップボタンをクリックした際の設定
jQuery(".pagetop").click(function () {
  jQuery("body,html").animate(
    {
      scrollTop: 0, //ページトップまでスクロール
    },
    650
  ); //ページトップスクロールの速さ。数字が大きいほど遅くなる
  return false; //リンク自体の無効化
});

// 学年 チェックされた際のクラス追加
jQuery("#school-year input[type='radio']").change(function () {
  jQuery(
    "#school-year input[type='radio'][name='" + jQuery(this).attr("name") + "']"
  ).each(function () {
    if (jQuery(this).is(":checked")) {
      jQuery(this).parent().addClass("selected");
    } else {
      jQuery(this).parent().removeClass("selected");
    }
  });
});

// 同意

jQuery(function () {
  jQuery("#acceptance").click(function () {
    //チェックボックスのチェックの有無を調べる
    let flag = jQuery(this).prop("checked");

    //チェックボックスへのチェックの有無でコンテンツの背景色・文字色を変更する
    if (flag) {
      //背景色を黒に
      jQuery(".form_agree").css("background", "#009380");
      //文字色を白に
      jQuery(".form_agree").css("color", "#fff");
    } else {
      jQuery(".form_agree").css("background", "#f9f9f9");
      //文字色を白に
      jQuery(".form_agree").css("color", "#000");
    }
  });
});

// 合格実績のメニュー
jQuery(function () {
  var scrollStart = jQuery(".or-menu").offset().top; //ページ上部からの距離を取得
  var scrollEnd = jQuery(".or-menu").offset().top; //ページ上部からの距離を取得
  var distance = 0;

  jQuery(document).scroll(function () {
    distance = jQuery(this).scrollTop(); //スクロールした距離を取得

    if (scrollStart <= distance) {
      //スクロール距離が『.or-menu』の位置を超えたら
      jQuery(".gj-fixed-btn").addClass("sp-active"); //class『fixed』を追加
    } else if (scrollStart >= distance) {
      //スクロールがページ上部まで戻ったら
      jQuery(".gj-fixed-btn").removeClass("sp-active"); //class『fixed』を削除
    }
  });
});

// 地図 Google maps JavaScript api
// 地図 Google maps JavaScript api
var map;
var marker = [];
var infoWindow = [];

// 神奈川
var markerData = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "あざみ野校",
    address: "横浜市青葉区あざみ野2-9-22",
    link: "https://toshin-azamino.com",
    lat: 35.5681697,
    lng: 139.5515594,
  },
  {
    name: "小田急相武台前校",
    address: "座間市相武台1-35-7 第26菊地ビル2F",
    link: "https://toshin-soubudai.com",
    lat: 35.49934693,
    lng: 139.4072539,
  },
  {
    name: "上溝校",
    address: "相模原市中央区上溝7-17-22 大谷ビル2F",
    link: "https://toshin-kamimizo.com",
    lat: 35.55785435,
    lng: 139.3626063,
  },
  {
    name: "相模大野校",
    address: "相模原市南区相模大野3-9-1 相模大野モアーズ5F",
    link: "https://toshin-sagamiohno.com",
    lat: 35.53267052,
    lng: 139.4373721,
  },
  {
    name: "相模原橋本校",
    address: "相模原市緑区橋本6-4-15 Flos橋本2階",
    link: "https://toshin-hashimoto.com",
    lat: 35.59686267,
    lng: 139.3456401,
  },
  {
    name: "鷺沼校",
    address: "川崎市宮前区鷺沼三丁目2-2 エアフォルク鷺沼Ｂ１Ｆ",
    link: "https://toshin-saginuma.com",
    lat: 35.57954506,
    lng: 139.5721033,
  },
  {
    name: "中央林間駅西口校",
    address: "大和市中央林間3-5-11 野崎ビル5F",
    link: "https://toshin-chuo-rinkan.com",
    lat: 35.50774591,
    lng: 139.4434049,
  },
  {
    name: "東急日吉校",
    address: "横浜市港北区日吉本町1-2-15 河野ビル3F",
    link: "https://toshin-hiyoshi.com",
    lat: 35.55407203,
    lng: 139.6461921,
  },
  {
    name: "長津田駅南口校",
    address: "横浜市緑区長津田5-4-32 スズキコーポラス1Ｆ",
    link: "https://toshin-nagatsuta.com",
    lat: 35.53046257,
    lng: 139.4966201,
  },
  {
    name: "渕野辺校",
    address: "相模原市中央区淵野辺4-15-1 千成ビル４Ｆ",
    link: "https://toshin-fuchinobe.com",
    lat: 35.56937466,
    lng: 139.3954036,
  },
  {
    name: "宮崎台駅北口校",
    address: "神奈川県川崎市宮前区宮崎2-9-15 アーバンコート宮崎台2F",
    link: "https://toshin-miyazakidai.com",
    lat: 35.58798592,
    lng: 139.5902014,
  },
  {
    name: "宮前平校",
    address: "川崎市宮前区小台2-6-2 ラポール宮前平2F",
    link: "https://toshin-miyamaedaira.com",
    lat: 35.58430497,
    lng: 139.581835,
  },
];

// 東京都
var markerData2 = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "鶴川校",
    address: "東京都町田市能ヶ谷1-7-1 ダイヤモンドビル3-E＆F",
    link: "https://toshin-azamino.com",
    lat: 35.58411902476802,
    lng: 139.48187008172448,
  },
  {
    name: "成瀬校",
    address: "町田市南成瀬1-2-1-1 成瀬駅前ハイツ102",
    link: "https://toshin-naruse.com",
    lat: 35.53679990510921,
    lng: 139.47297016579589,
  },
  {
    name: "旗の台中原街道校",
    address: "東京都品川区旗の台2-8-4 須賀マンション1F",
    link: "https://toshin-kamimizo.com",
    lat: 35.6067418718916,
    lng: 139.70296411420,
  },
  {
    name: "南町田校",
    address: "町田市鶴間3-2-2 アーベイン細野402",
    link: "https://toshin-sagamiohno.com",
    lat: 35.511152472176704,
    lng: 139.4699263523035,
  },
  {
    name: "武蔵小山駅前校",
    address: "東京都品川区小山3丁目1-2サンタグリュス武蔵小山3F",
    link: "https://toshin-hashimoto.com",
    lat: 35.620303158157554,
    lng: 139.70272111056,
  },
  {
    name: "用賀校",
    address: "世田谷区用賀2-38-14 青木ビル2F",
    link: "https://toshin-youga.com",
    lat: 35.62702150705584,
    lng: 139.6349801835799,
  },
];

// 静岡
var markerData3 = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "清水駅前校",
    address: "静岡県静岡市清水区辻1丁目2-1 えじりあ204",
    link: "https://toshin-shimizu.com",
    lat: 35.02435017758071,
    lng: 138.487507881105,
  },
  {
    name: "沼津駅南口校",
    address: "静岡県沼津市大手町1丁目1-3 沼津産業ビル5F",
    link: "https://toshin-numazu.com",
    lat: 35.102865035672934,
    lng: 138.86080408285721,
  },
  {
    name: "沼津学園通り校",
    address: "静岡県沼津市三枚橋686-7 清光ビル2F",
    link: "https://toshin-numazugakuen.com",
    lat: 35.11592786298731,
    lng: 138.86708809079573,
  },
  {
    name: "三島駅前校",
    address: "静岡県三島市一番町15−32 芹澤ビル 3F",
    link: "https://toshin-mishima.com",
    lat: 35.126169567201416,
    lng: 138.9109366521811,
  },
];

// 愛知
var markerData4 = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "一社校",
    address: "名古屋市名東区一社1-86 大進ビル6F、7F",
    link: "https://toshin-issha.com",
    lat: 35.1680117298372,
    lng: 136.99556089805282,
  },
  {
    name: "杁中校",
    address: "名古屋市昭和区滝川町33番地 いりなかスクエア1階",
    link: "https://toshin-irinaka.com",
    lat: 35.142995443481446,
    lng: 136.95637572562526,
  },
  {
    name: "植田校",
    address: "名古屋市天白区植田1-1315 スカイビル植田1Ｆ",
    link: "https://toshin-ueda.com",
    lat: 35.12967153801741,
    lng: 136.986089427471,
  },
  {
    name: "春日井市役所前校",
    address: "春日井市鳥居松町6-55-1 春日井THXビル5Ｆ",
    link: "https://toshin-kasugai.com",
    lat: 35.24758919607657,
    lng: 136.97525486795868,
  },
  {
    name: "勝川校",
    address: "春日井市柏井町1-75 ポンプルムース2Ｆ",
    link: "https://toshin-kachigawa.com",
    lat: 35.23208727182774,
    lng: 136.95642888145272,
  },
  {
    name: "御器所校",
    address: "名古屋市昭和区阿由知通4-5 シェブランシュ6F",
    link: "https://toshin-gokiso.com",
    lat: 35.1493547100258,
    lng: 136.93392511213105,
  },
  {
    name: "平針校",
    address: "名古屋市天白区平針3-614 平針ビルディング2Ｆ",
    link: "https://toshin-hirabari.com",
    lat: 35.12221267932078,
    lng: 137.00763190843753,
  },
  {
    name: "藤が丘駅南校",
    address: "名古屋市名東区 藤見が丘6 セントラルスクウェア4F",
    link: "https://toshin-fujigaoka.com",
    lat: 35.181953390123034,
    lng: 137.0206291256266,
  },
  {
    name: "瑞穂新瑞橋校",
    address: "名古屋市瑞穂区瑞穂通8-14 神谷ビル１F",
    link: "https://toshin-aratamabashi.com",
    lat: 35.117192170964096,
    lng: 136.93637248247273,
  },
  {
    name: "本山校",
    address: "名古屋市千種区 四谷通1-1 イリヤ本山2F",
    link: "https://toshin-motoyama.com",
    lat: 35.16338250830632,
    lng: 136.9633953967908,
  },
  {
    name: "八事校",
    address: "名古屋市昭和区山手通5-33-2 八事中央ビル2Ｆ",
    link: "https://toshin-yagoto.com",
    lat: 35.13722530103398,
    lng: 136.96502392747118,
  },

];

// 岡山
var markerData5 = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "岡山駅前第一セントラルビル校",
    address: "岡山県岡山市北区本町6-30 第一セントラルビル2号館 6F",
    link: "https://toshin-okayamaekimae.com",
    lat: 34.6650265288417,
    lng: 133.91999208153305,
  },
  {
    name: "倉敷駅前校",
    address: "岡山県倉敷市阿知1-7-1 倉敷天満屋 5階",
    link: "https://toshin-kurashiki.com",
    lat: 34.6080931642072,
    lng: 133.76529547090,
  },
  {
    name: "倉敷茶屋町校",
    address: "倉敷市茶屋町271-11 栗坂ビル1F・2F",
    link: "https://toshin-chayamachi.com",
    lat: 34.5769602442057,
    lng: 133.82486962402,
  },
];

// 高知
var markerData6 = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "高知本町校",
    address: "高知県高知市本町2丁目1-7",
    link: "https://toshin-kochihonmachi.com",
    lat: 33.5596089446182,
    lng: 133.53735148165,
  },
  {
    name: "高知橋前校",
    address: "高知県高知市駅前町3番22号",
    link: "https://toshin-kochibashimae.com",
    lat: 33.5649309922214,
    lng: 133.54311845281,
  },

];
// 熊本
var markerData7 = [
  // マーカーを立てる場所名・緯度・経度・リンク
  {
    name: "宇土駅前校",
    address: "東進衛星予備校宇土駅前校",
    link: "https://toshin-uto.com",
    lat: 32.7115933474969,
    lng: 130.65920466010,
  },
  {
    name: "八代松江通り校",
    address: "熊本県八代市横手新町15-9",
    link: "https://toshin-yatsusiro.com",
    lat: 32.5189173211627,
    lng: 130.60001909696,
  },

];


function initMap() {
  // 地図の作成
  window.onload = () => {
    // URLの取得
    var todoFuken = document.getElementById("todofuken");
    var todoFukenText = todoFuken.innerText;
    // 神奈川
    if (todoFukenText == "神奈川県の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 35.55845140367339,
        lng: 139.4818015079629,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 12, // 地図のズームを指定
        });
      }
      // マーカー毎の処理（神奈川）
      for (var i = 0; i < markerData.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData[i]["lat"],
          lng: markerData[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData[i]["name"] +
            '</p><p class="map_address">' +
            markerData[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }

    // 東京
    else if (todoFukenText == "東京都の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 35.579786064058354,
        lng: 139.573165478769,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 11, // 地図のズームを指定
        });
      }

      // マーカー毎の処理（東京）
      for (var i = 0; i < markerData2.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData2[i]["lat"],
          lng: markerData2[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData2[i]["name"] +
            '</p><p class="map_address">' +
            markerData2[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData2[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }
    // 静岡
    else if (todoFukenText == "静岡県の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 35.09603186833757,
        lng: 138.69890297050873,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #areagooglemapに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #areagooglemapに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      }

      // マーカー毎の処理（静岡）
      for (var i = 0; i < markerData3.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData3[i]["lat"],
          lng: markerData3[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData3[i]["name"] +
            '</p><p class="map_address">' +
            markerData3[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData3[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }
    // 愛知
    else if (todoFukenText == "愛知県の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 35.184057979074815,
        lng: 136.96309661014092,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #areagooglemapに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #areagooglemapに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 11, // 地図のズームを指定
        });
      }

      // マーカー毎の処理
      for (var i = 0; i < markerData4.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData4[i]["lat"],
          lng: markerData4[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData4[i]["name"] +
            '</p><p class="map_address">' +
            markerData4[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData4[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }
    // 岡山
    else if (todoFukenText == "岡山県の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 34.63964938260037,
        lng: 133.89272397838664,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 11, // 地図のズームを指定
        });
      }

      // マーカー毎の処理（神奈川）
      for (var i = 0; i < markerData5.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData5[i]["lat"],
          lng: markerData5[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData5[i]["name"] +
            '</p><p class="map_address">' +
            markerData5[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData5[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }
    // 高知
    else if (todoFukenText == "高知県の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 33.56551327456954,
        lng: 133.54323059328536,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 14, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 14, // 地図のズームを指定
        });
      }

      // マーカー毎の処理（神奈川）
      for (var i = 0; i < markerData6.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData6[i]["lat"],
          lng: markerData6[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData6[i]["name"] +
            '</p><p class="map_address">' +
            markerData6[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData6[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }
    // 熊本
    else if (todoFukenText == "熊本県の校舎一覧") {
      var mapLatLng = new google.maps.LatLng({
        lat: 32.63818690688098,
        lng: 130.66766540034408,
      }); // 緯度経度のデータ作成 中心の緯度経度
      // メディアクエリ
      if (window.matchMedia("(max-width: 768px)").matches) {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      } else {
        map = new google.maps.Map(document.getElementById("areagooglemap"), {
          // #kanagawaに地図を埋め込む
          center: mapLatLng, // 地図の中心を指定
          zoom: 10, // 地図のズームを指定
        });
      }

      // マーカー毎の処理（神奈川）
      for (var i = 0; i < markerData7.length; i++) {
        markerLatLng = new google.maps.LatLng({
          lat: markerData7[i]["lat"],
          lng: markerData7[i]["lng"],
        }); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({
          // マーカーの追加
          position: markerLatLng, // マーカーを立てる位置を指定
          map: map, // マーカーを立てる地図を指定
        });

        infoWindow[i] = new google.maps.InfoWindow({
          // 吹き出しの追加
          content:
            '<div class="map_box"><p class="kosha_name">' +
            markerData7[i]["name"] +
            '</p><p class="map_address">' +
            markerData7[i]["address"] +
            '</p><a class="map_link_btn" href="' +
            markerData7[i]["link"] +
            '">校舎詳細ページへ</a></div>', // 吹き出しに表示する内容
        });

        markerEvent(i); // マーカーにクリックイベントを追加
        marker[i].setOptions({
          // マーカーのオプション設定
          // marker.setOptions({// マーカーのオプション設定
          icon: {
            url: "/wp-content/uploads/pin2.png", // マーカーの画像を変更
          },
        });
      }
    }
  };
}

// 地図の作成

// マーカーにクリックイベントを追加
// Open and Close
let previOus;
function markerEvent(i) {
  marker[i].addListener("click", function () {
    if (previOus !== undefined) {
      infoWindow[previOus].close(map, marker[previOus]);
    }
    infoWindow[i].open(map, marker[i]);
    previOus = i;
  });
}




const path = location.pathname;
const regist = document.getElementsByName('select-item');
const titleTags = [document.querySelector('h1'), document.querySelector('.smb-section__title'), document.querySelector('h3')];
const breadcrumb = document.querySelectorAll('.p-breadcrumb__text');

const setTitle = (index) => {
  const text = '資料請求・お申し込み';
  titleTags[0].innerText = text;
  titleTags[1].innerText = text;
  breadcrumb[1].innerText = text;
  titleTags[2].innerHTML = `${text}における<br class="u-only-sp">個人情報の取扱いについて`;
  regist[index].setAttribute("checked", "checked");
};

const urlType = new URLSearchParams(location.search).get('type');
if (urlType === 'regist') setTitle(1);
if (urlType === 'taiken') setTitle(3);
if (urlType === 'season') setTitle(4);

// 模試
let point = document.querySelectorAll('.moshi-up .__label');

for (var i = 0; i < point.length; i++) {
  point[i].innerText = "POINT";
}


/*
夏期講習日付指定ボタン切り替え
*/

// ボタン要素を取得
const buttons1 = document.querySelectorAll('.btn0731');
const buttons2 = document.querySelectorAll('.btn0801');

// 今日の日付を取得
const today = new Date();
const targetDate = new Date(2024, 7, 1); // 8月は7月がインデックスになります　締切日の設定

// 日付を比較し、ボタンの表示・非表示を切り替える
if (today <= targetDate) {
  // buttons1 の全ての要素に対してスタイルを設定 （締切日）より今日の方が小さい（締切前）のとき
  buttons1.forEach(button => {
    button.style.display = 'block';
  });
  // buttons2 の全ての要素に対してスタイルを設定
  buttons2.forEach(button => {
    button.style.display = 'none';
  });
} else {
  // buttons1 の全ての要素に対してスタイルを設定
  buttons1.forEach(button => {
    button.style.display = 'none';
  });
  // buttons2 の全ての要素に対してスタイルを設定
  buttons2.forEach(button => {
    button.style.display = 'block';
  });
}



/*
モーダル
*/
document.addEventListener('DOMContentLoaded', function () {
  const openButtons = document.querySelectorAll('.js-open-modal');
  const closeButtons = document.querySelectorAll('.js-close-modal');
  const modals = document.querySelectorAll('.modal-overlay');

  // モーダルを開く
  openButtons.forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();
      const modalId = this.getAttribute('data-id');
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.style.display = 'flex';
      }
    });
  });

  // モーダルを閉じる
  closeButtons.forEach(button => {
    button.addEventListener('click', function () {
      const modal = this.closest('.modal-overlay');
      if (modal) {
        modal.style.display = 'none';
      }
    });
  });

  // モーダルの外をクリックしたときに閉じる
  modals.forEach(modal => {
    modal.addEventListener('click', function (event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
});

const links = document.querySelectorAll('.youtube-link');
const popup = document.querySelector('.popup');
const popupOverlay = document.querySelector('.popup-overlay');
const iframe = popup.querySelector('iframe');
const closePopupButton = document.querySelector('.close-popup');

links.forEach(link => {
  link.addEventListener('click', (event) => {
    event.preventDefault();
    const shortUrl = link.getAttribute('href');
    const videoId = shortUrl.split('/').pop(); // 短縮URLからID抽出
    const embedUrl = `https://www.youtube.com/embed/${videoId}`;

    iframe.src = embedUrl; // iframeに埋め込みURLを設定
    popup.classList.add('active');
    popupOverlay.classList.add('active');
  });
});

closePopupButton.addEventListener('click', () => {
  popup.classList.remove('active');
  popupOverlay.classList.remove('active');
  iframe.src = ''; // iframeをリセット
});

popupOverlay.addEventListener('click', () => {
  popup.classList.remove('active');
  popupOverlay.classList.remove('active');
  iframe.src = ''; // iframeをリセット
});