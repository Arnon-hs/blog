<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?=$description?>">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
  <link rel="stylesheet" href="/template/css/style.css">
  <link rel="shortcut icon" href="/template/images/icons/ico.png" type="image/png">
  <title><?= $title? $title:'Блог';?></title>
  <script src="/template/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script> 
  <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  <script>
      window.onload = function () {
        document.body.classList.add('loaded_hiding');
        window.setTimeout(function () {
          document.body.classList.add('loaded');
          document.body.classList.remove('loaded_hiding');
        }, 500);
      }
    </script>
</head>

<body>
    <div class="preloader">
        <svg class="preloader__image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path fill="currentColor"
            d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z">
          </path>
        </svg>
    </div>
  <div id="layout" class="pure-g">
    <div class="sidebar pure-u-1-4 pure-u-md-1-4">
        <div class="login">
          <nav class="nav">
            <ul class="nav-list">
              <?php if(User::isGuest()): ?>
                <li class="nav-item">
                    <a class="pure-button" href="/user/login/">Войти</a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                    <a class="pure-button" href="/cabinet/">Аккаунт</a>
                </li>
                <li class="nav-item">
                    <a class="pure-button" href="/post/create/">Добавить пост</a>
                </li>
                <li class="nav-item">
                    <a class="pure-button" href="/user/logout/">Выход</a>
                </li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
        <div class="header">
          <a href="/"><h1 class="brand-title">Блог разработчика</h1></a>
          <h2 class="brand-tagline">Web-приложений</h2>
        </div>
    </div>