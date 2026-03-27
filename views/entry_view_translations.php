<?php
declare(strict_types=1);
namespace WorldlangDict;




// region function
function view_translation(WorldlangDictConfig $config, Request $request, string $lang, string $data) {
    $gstart = true;
    print("\t\t<tr><th>{$lang}</th><td>{$data}</tr>\n");
    return;
    foreach($data as $group):
        if (!$gstart) print('; ');
        $gstart = false;
        $tstart = true;
        
        foreach($group as $translation):
            if (!$tstart) :
                print(', ');
            endif;
            $tstart = false;
            $trans_note_preceeding = '';
            $trans_note_following = '';

            // var_dump($translation);
            // Check for preceeding translation note using colon
            if (($pos = mb_strpos($translation, ':', encoding:"UTF-8")) !== false) {
                $trans_note_preceeding = mb_trim(substr($translation, 0, $pos+1), encoding:"UTF-8");
                $translation = mb_trim(mb_substr($translation, $pos+1, encoding:"UTF-8"), encoding:"UTF-8");
            }
            
            $slug = mb_trim(mb_strtolower(preg_replace('/\((.+)\)/U', '', strip_tags($translation)), encoding:"UTF-8"), encoding:"UTF-8");  // regex removes parentheticals (...)

            // TODO: link this!
            if (!str_contains($translation, '<a')) :
                print($trans_note_preceeding);
                print(' <a href="');
                print(WorldlangDictUtils::makeUri(config:$config, controller:'natlang-search', arg:$slug, request:$request));
                print('" class="hl h1">');
                print($translation);
                print('</a> ');
                print($trans_note_following);
            else:
                print('<span class="hl h1">');
                print($translation);
                print('</span>');
            endif;
        endforeach;
    endforeach;
    print("</td></tr>");
}
// endregion




?>

<!-- ------------------ -->
<!-- Entry: Translation -->
<!-- ------------------ -->
<section class="translation">
    <details>
    <summary><?php

if (!ENTRY_SEPARATE_TRANS_CAT && !empty($entry['trans'][$request->lang])):
    $gstart = true;
    
    foreach($entry['trans'][$request->lang] as $group):
        if (!$gstart) :
            ?>; <?
        endif;
        $gstart = false;
        $tstart = true;
        
        
        foreach($group as $translation):
            if (!$tstart) :
                ?>, <?
            endif;
            $tstart = false;
            $trans_note_preceeding = '';
            $trans_note_following = '';

            // var_dump($translation);
            // Check for preceeding translation note using colon
            if (($pos = mb_strpos($translation, ':', encoding:"UTF-8")) !== false) {
                $trans_note_preceeding = mb_trim(substr($translation, 0, $pos+1), encoding:"UTF-8");
                $translation = mb_trim(mb_substr($translation, $pos+1, encoding:"UTF-8"), encoding:"UTF-8");
            }
            
            $slug = mb_trim(mb_strtolower(preg_replace('/\((.+)\)/U', '', strip_tags($translation)), encoding:"UTF-8"), encoding:"UTF-8");  // regex removes parentheticals (...)

            // TODO: link this!
            if (!str_contains($translation, '<a')) :
                print($trans_note_preceeding.' ');
                ?><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'natlang-search', arg:$slug, request:$request) ?>" class="hl h1"><?=$translation?></a><?
                print(' '.$trans_note_following);
            else:
                ?><span class="hl h1"><?=$translation?></span><?
            endif;
        endforeach;
    endforeach;
endif;

print(PHP_EOL);

if (ENTRY_SEPARATE_TRANS_CAT && !empty($entry['trans_v2'][$request->lang])):
    $gstart = true;
    
    foreach($entry['trans_v2'][$request->lang] as $category => $group):

        if (!empty($category)) {
            print("\t\t<h3>{$category}</h3>\n");
        }
        print("\t\t<div>");
        $tstart = true;
        
        
        foreach($group as $translation):
            if (!$tstart) :
                ?>, <?
            endif;
            $tstart = false;
            $trans_note_preceeding = '';
            $trans_note_following = '';

            // var_dump($translation);
            // Check for preceeding translation note using colon
            if (($pos = mb_strpos($translation, ':')) !== false) {
                $trans_note_preceeding = mb_trim(substr($translation, 0, $pos+1));
                $translation = mb_trim(mb_substr($translation, $pos+1));
            }
            
            $slug = mb_trim(mb_strtolower(preg_replace('/\((.+)\)/U', '', strip_tags($translation))));  // regex removes parentheticals (...)

            // TODO: link this!
            if (!str_contains($translation, '<a')) :
                echo($trans_note_preceeding.' ');
                ?><a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'natlang-search', arg:$slug, request:$request) ?>" class="hl h1"><?=$translation?></a><?php
                if (!empty($trans_note_following)) :
                    echo(' '.$trans_note_following);
                endif;
            else:
                ?><span class="hl h1"><?=$translation?></span><?
            endif;
        endforeach;

        print("</div>\n");
    endforeach;
endif;
?>
        <span class="expand_icon">[+]</span>
        <span class="collapse_icon">[-]</span>
    </summary>

    <table class="lang_list">
<?php
foreach ($entry['trans html'] as $lang=>$data) {
    if (empty($data) || $lang === $request->lang) continue;
    view_translation($config, $request, $lang, $data);
}
?>
    </table>

    </details>
<?php



if (isset($entry['entry notes'])) :
    foreach ($entry['entry notes'] as $type=>$data) :
        switch ($type) :
            case 'am oko':
            case 'kurto lexi':
            case 'kompara':
                ?>  <p><?= $config->getTrans('entry note '.$type); ?>: <?
                $nfirst = true;
                foreach ($entry['entry notes'][$type] as $note_slug => $note_term) :

                    // old api2 uses slug=>null sometimes, sometimes gets terms, and is a bit of a mess.
                    // unlcear if it always usews proper slugs, probably sometimes gets proper term?
                    // TODO: remove 2 lines when using Entry class based API.
                    if (is_int($note_slug)) $note_slug = $note_term;
                    if (empty($note_term)) $note_term = $note_slug;

                    $note_slug = mb_trim($slug, encoding:"UTF-8");
                    if (!$nfirst) {
                        echo(", ");
                    } else {
                        $nfirst = false;
                    }
                    ?>  <a href="<?= WorldlangDictUtils::makeUri(config:$config, controller:'word', arg:$note_slug, request: $request); ?>" lang="<?= WL_CODE_FULL; ?>"><?= $note_term; ?></a><?
                endforeach;
                ?>.</p><?
                break;
            case 'gramati':
                $page = explode("#", $data)[0];
                ?>  <p><?= $config->getTrans('entry note gramati'); ?> <a href="<?=$config->grammar_note_url;?><?= $data; ?>"><?= $config->getTrans('entry note gramati '.$page); ?></a>.</p>   <?
                break;
            case 'Nota':
                ?>  <p><?= $entry['entry notes'][$type]; ?></p>  <?
                break;
        endswitch;
    endforeach;
endif;
?>


</section>
