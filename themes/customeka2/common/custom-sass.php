<?php 

$light_gray: '#dfe2e2'; 
$dark_gray: '#5a5a5a';
$title_blue: '#859ca2';
$slate: '#4b6569';
$very_pale_blue: '#def9ff';
$bright_blue: '#56ACBA';
$hover_blue: '#3acacc';
$pale_blue: '#98c4c9';
$footer_blue: '#2f3e4a';
$off_white: '#f8f8f8';

$sass = "
.winter {

    body {
        background-color: $footer_blue;
        color: $dark_gray;
    }
    
    h1, #site-title a { color:#859ca2; }

    input[type=submit], button, .button, #advanced-search { background-color: $slate; }

    input[type=text], input[type=password], textarea { background-color: $light_gray; }

    a {
        &:link { color: $bright_blue; }
        &:visited { color: $pale_blue; }
        &:hover, &:active { color: $hover_blue; }
    }
    
    header { background-color: #fff; }
    
    nav.top { 
        background-color: $bright_blue; 
        
        li:hover a { color: #fff; }

        a:link, a:visited  { color: $very_pale_blue; }
        a:active, a:hover  { color: #fff; }
        
        ul li ul {
            background-color: $bright_blue;
            li {
                & > a:link, & > a:visited, & > a:active, & > a:hover { color:#fff; }
            }
        }
    }

    #intro { color: #fff; }
    
    #content,
    #secondary-nav .current a,
    #secondary-nav a.current,
    .secondary-nav .current a,
    .secondary-nav a.current,
    .exhibit-section-nav .current a {
        background-color: $pale_blue;
    }

    #home #content > div { 
        border-color: $slate; 
    }

    #content {
        
        h1 { color: #fff; }
        
        h2 { border-color: $light_gray; }

        div { border-color: $title_blue; }
        
        & > div, #primary > div, #sidebar > div,
        #advanced-search-form > div, #exhibit-pages { 
            border-color: $slate;
        }
        
        #primary > div, #sidebar > div { background-color: #fff; }
    
        .pagination_previous a, .pagination_next a { 
            background-color: $bright_blue; 
        }
        
        .pagination { 
            a:link, a:visited { color: $very_pale_blue; }
            a:hover, a:active { color: #fff; }
        }
               
        .pagination input[type=text] { border-color: $light_gray; }

        nav .pagination_list { 
            background-color: $bright_blue;             
        }
        
        .items-nav, .secondary-nav, #secondary-nav, #outputs, #exhibit-child-pages {
            a:link, a:visited { color: $very_pale_blue; }
            a:hover, a:active { color: #fff; }
        }
        
        .item-img { border-color: $light_gray; }
        
        div.hTagcloud {
            border: 0;
            background-color: transparent;
            @include box-shadow(transparent 0 0 0);
        }
    }

    #search-results th { background-color: $slate; }

    #search-filters, #item-filters {
        li { background-color: $very_pale_blue; }
    }
    
    .page #content { 
        border-color: $slate; 
    }

    footer {
        background-color: $footer_blue;
    }

    footer p {
        color:#fff;
    }
    
    .exhibit-page-nav { background-color: $slate; }
    
    .exhibit-page-nav .current, .exhibit-child-nav .current { background-color: rgba(0,0,0,.1); }
    
    .exhibit-page-nav {
        a:link, a:visited { color: $very_pale_blue; }
        a:hover, a:active { color: #fff; }
    }

    #exhibit-page-navigation {
        a, span { background-color: #fff; }
    }
} 
"; 
