<?php

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Paginator
  {
      public $items_per_page;
      public $items_total;
      public $num_pages = 1;
      public $limit;
	  public $current_page;
      public $default_ipp;
	  public $path = 0;
	  public $path_after;
      private $mid_range;
      private $low;
      private $high;
      private $retdata;
      private $querystring;
	  private static $instance; 
      
      
      /**
       * Paginator::__construct()
       * 
       * @return
       */
      private function __construct()
      {
          $this->current_page = 1;
          $this->mid_range = 7;
          $this->items_per_page = (isset($_GET['ipp']) and !empty($_GET['ipp'])) ? sanitize($_GET['ipp']) : $this->default_ipp;
      }

      /**
       * Paginator::instance()
       * 
       * @return
       */
	  public static function instance(){
		  if (!self::$instance){ 
			  self::$instance = new Paginator(); 
		  } 
	  
		  return self::$instance;  
	  }
	     
      /**
       * Paginator::paginate()
       * 
       * @return
       */
      
       public function paginate()
      { 
      $this->items_per_page = (isset($_GET['ipp']) and !empty($_GET['ipp'])) ? intval($_GET['ipp']) : $this->default_ipp;
          $this->num_pages = ceil($this->items_total / $this->items_per_page);
          
          $this->current_page = intval(sanitize(get('pg')));
          if ($this->current_page < 1 or !is_numeric($this->current_page))
              $this->current_page = 1;
          if ($this->current_page > $this->num_pages)
              $this->current_page = $this->num_pages;
          $prev_page = $this->current_page - 1;
          $next_page = $this->current_page + 1;
          
          if (isset($_GET)) {
              $args = explode("&amp;", $_SERVER['QUERY_STRING']);
              foreach ($args as $arg) {
                  $keyval = explode("=", $arg);
                  if ($keyval[0] != "pg" && $keyval[0] != "ipp")
                      $this->querystring .= "&amp;" . sanitize($arg);
              }
          }
          
          if (isset($_POST)) {
              foreach ($_POST as $key => $val) {
                  if ($key != "pg" && $key != "ipp")
                      $this->querystring .= "&amp;$key=" . sanitize($val);
              }
          }
          
          if ($this->num_pages > 1) {
              if ($this->current_page != 1 && $this->items_total >= $this->default_ipp) {
                  if ($this->path) {
            $this->retdata = "<li><a href=\"".$this->path."pg=".$prev_page."{$this->path_after}\"><i class=\"fa fa-angle-left\"></i></a></li>";
                  } else {
                      $this->retdata = "<li><a href=\"" . phpself() . "?pg=$prev_page&amp;ipp=$this->items_per_page$this->querystring\"><i class=\"fa fa-angle-left\"></i></a></li>";
                  }
              } else {
                  $this->retdata = "<li class=\"disabled\"><a><i class=\"fa fa-angle-left\"></i></a></li>";
              }
              
              $this->start_range = $this->current_page - floor($this->mid_range / 2);
              $this->end_range = $this->current_page + floor($this->mid_range / 2);
              
              if ($this->start_range <= 0) {
                  $this->end_range += abs($this->start_range) + 1;
                  $this->start_range = 1;
              }
              if ($this->end_range > $this->num_pages) {
                  $this->start_range -= $this->end_range - $this->num_pages;
                  $this->end_range = $this->num_pages;
              }
              $this->range = range($this->start_range, $this->end_range);
              
              for ($i = 1; $i <= $this->num_pages; $i++) {
                  if ($this->range[0] > 2 && $i == $this->range[0])
                      $this->retdata .= "<li class=\"disabled item\"><a> ... </a></li>";

                  if ($i == 1 or $i == $this->num_pages or in_array($i, $this->range)) {
                      if ($i == $this->current_page) {
                          $this->retdata .= "<li class=\" active\"><a title=\"" . Core::$word->PAG_GOTO . $i . Core::$word->PAG_OF . $this->num_pages . "\">$i</a></li>";
                      } else {
                          if ($this->path) {
                $this->retdata .= "<li><a  title=\"Go To $i of $this->num_pages\" href=\"".$this->path."pg=$i{$this->path_after}\">$i</a></li>";
                          } else {
                              $this->retdata .= "<li><a title=\"Go To $i of $this->num_pages\" href=\"" . phpself() . "?pg=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a></li>";
                          }
                      }
                  }

                  if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 && $i == $this->range[$this->mid_range - 1])
                      $this->retdata .= "<li class=\"disabled \"><a> ... </a></li>";
              }

              if ($this->current_page != $this->num_pages && $this->items_total >= $this->default_ipp) {
                  if ($this->path) {
            $this->retdata .= "<li><a href=\"".$this->path."pg=".$next_page."{$this->path_after}\"><i class=\"fa fa-angle-right\"></i></a></li>";
                  } else {
                      $this->retdata .= "<li><a href=\"" . phpself() . "?pg=$next_page&amp;ipp=$this->items_per_page$this->querystring\"><i class=\"fa fa-angle-right\"></i></a></li>\n";
                  }
              } else {
                  $this->retdata .= "<li class=\"disabled\"><a><i class=\"fa fa-angle-right\"></i></a></li>";
              }
        
          } else {
              for ($i = 1; $i <= $this->num_pages; $i++) {
                  if ($i == $this->current_page) {
                      $this->retdata .= "<li class=\"active\"><a>$i</a></li>";
                  } else {
            if ($this->path) {
              $this->retdata .= "<li><a href=\"".$this->path . "pg=$i{$this->path_after}\">$i</a></li>";
            } else {
                          $this->retdata .= "<li><a href=\"" . phpself() . "?pg=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a></li>";
            }
                  }
              }
          }
          $this->low = ($this->current_page - 1) * $this->items_per_page;
          $this->high = $this->current_page * $this->items_per_page - 1;
          $this->limit = ($this->items_total == 0) ? '' : " LIMIT $this->low,$this->items_per_page";
      }
      
     
      
      /**
       * Paginator::items_per_page()
       * 
       * @return
       */
      public function items_per_page()
      {
          $items = '';
          $ipp_array = array(10, 25, 50, 75, 100);
          foreach ($ipp_array as $ipp_opt)
            $items .= ($ipp_opt == $this->items_per_page) ? "<li class=\"active\"><a href=".phpself().'?pg=1&amp;ipp='.$ipp_opt.$this->querystring.">$ipp_opt</a></li>\n" : "<li><a href=".phpself().'?pg=1&amp;ipp='.$ipp_opt.$this->querystring.">$ipp_opt</a></li>\n";
          return ($this->num_pages >= 1) ? "<div class=\"dropdown\"><button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Show entries<span class=\"caret\"></span></button><ul class=\"dropdown-menu\"> $items </ul></div>\n" : '';
      }
      
      /**
       * Paginator::jump_menu()
       * 
       * @return
       */
      public function jump_menu()
      {
          $option = '';
      //$option .= "<option  value=\"\">" . Core::$word->PAG_GOTO . "</option>";
          for ($i = 1; $i <= $this->num_pages; $i++) {
              $option .= ($i == $this->current_page) ? "<li class=\"active\"><a href=".phpself().'?pg='.$i.$this->querystring.'&amp;ipp='.$this->items_per_page.">$i</a></li>\n" : "<li><a href=".phpself().'?pg='.$i.$this->querystring.'&amp;ipp='.$this->items_per_page.">$i</a></li>";
          }
          return ($this->num_pages >= 1) ? "<div class=\"dropdown\"><button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">Jump to Page<span class=\"caret\"></span></button><ul class=\"dropdown-menu dropup\"> $option </ul></div>" : '';
      }

      
      /**
       * Paginator::display_pages()
       * 
       * @return
       */
      public function display_pages()
      {
          return($this->items_total > $this->items_per_page) ? '<div class="text-center post-showinfo"><ul class="post-navigation pagination">' . $this->retdata . '</ul></div>' : "";
      }
  }
?>