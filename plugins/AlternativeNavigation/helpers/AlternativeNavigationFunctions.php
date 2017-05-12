<?php
  
    /**
 * Return the markup for the exhibit page navigation.
 * not including title
 *
 * @param ExhibitPage|null $exhibitPage If null, uses the current exhibit page
 * @return string
 */
    
function exhibit_builder_page_alt_nav($exhibitPage = null)
{
    if (!$exhibitPage) {
        if (!($exhibitPage = get_current_record('exhibit_page', false))) {
            return;
        }
    }

    $exhibit = $exhibitPage->getExhibit();
    $html = '<ul class="exhibit-page-nav navigation" id="secondary-nav">' . "\n";
    $pagesTrail = $exhibitPage->getAncestors();
    $pagesTrail[] = $exhibitPage;
    $html .= '<li>';
    $html .= '<a class="exhibit-title" href="'. html_escape(exhibit_builder_exhibit_uri($exhibit)) . '">';
    $html .= html_escape($exhibit->title) .'</a></li>' . "\n";
    
    $levelNumber = 1;
    
    foreach ($pagesTrail as $page) {
        $linkText = $page->title;
        $pageExhibit = $page->getExhibit();
        $pageParent = $page->getParent();
        $pageSiblings = ($pageParent ? exhibit_builder_child_pages($pageParent) : $pageExhibit->getTopPages()); 

        $html .= "<li>\n<ul class=\"exhibit-nav-level-$levelNumber\">\n";
        $levelNumber +=1;
        
        foreach ($pageSiblings as $pageSibling) {
            $html .= '<li' . ($pageSibling->id == $page->id ? ' class="current"' : '') . '>';
            $html .= '<a class="exhibit-page-title" href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $pageSibling)) . '">';
            $html .= html_escape($pageSibling->title) . "</a></li>\n";
        }
        $html .= "</ul>\n</li>\n";
    }
    $html .= '</ul>' . "\n";
    $html = apply_filters('exhibit_builder_page_nav', $html);
    return $html;
}

