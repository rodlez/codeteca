<?php

namespace App\Services;

// Models
use App\Models\CodeEntry;
use App\Models\CodeTag;
use App\Models\CodeCategory;
use App\Models\CodeType;
use App\Models\CodeFile;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\CodeStoreRequest;
use File;
// Collection
use Illuminate\Database\Eloquent\Collection;
//Exceptions
use Exception;
use Illuminate\Database\QueryException;
use App\Exceptions\CustomException;
// Log
use Illuminate\Support\Facades\Log;
use stdClass;


class CodeService
{

    public function test()
    {
        dd('test injection CodeService');
    }

    /**
     * Inset new Entry and insert the tags in the pivot table code_entry_tag   
     */
    public function insertEntry(array $data): CodeEntry
    {
        $entry = CodeEntry::create($data);
        $entry->tags()->sync($data['selectedTags']);

        return $entry;
    }

    /**
     * Update an Entry and insert the tags in the pivot table code_entry_tag   
     */
    public function updateEntry(CodeEntry $entry, array $data): CodeEntry
    {
        $entry->update($data);
        $entry->tags()->sync($data['selectedTags']);

        return $entry;
    }

    /**
     *  Get all the types orderby asc
     */
    public function getTypes(): Collection
    {
        return CodeType::orderBy('name')->get();
    }

    /**
     *  Get all the categories orderby asc
     */
    public function getCategories(): Collection
    {
        return CodeCategory::orderBy('name')->get();
    }

    /**
     *  Get all the categories orderby asc
     */
    public function getTags(): Collection
    {
        return CodeTag::orderBy('name')->get();
    }

    /**
     *  Get tags for this entry
     * 
     * @param Code $entry
     * @param string $separator Value to separate between tags (- / *) 
     */
    public function displayEntryTags(CodeEntry $entry, string $separator = ''): array
    {
        $tags = $entry->tags;
        $count = 0;
        $result = [];

        foreach ($tags as $tag) {
            $count++;
            if ($count == count($tags))
                $result[] = $tag->name;

            else {
                $result[] = $tag->name . ' ' . $separator . ' ';
            }
        }

        return $result;
    }

    public function getEntryTags(CodeEntry $entry): array
    {
        $tags = [];
        foreach ($entry->tags as $tag) {
            $tags[] = $tag->pivot->code_tag_id;
        }

        return $tags;
    }

    public function getFiles(CodeEntry $entry): Collection
    {
        return CodeFile::where('code_id', $entry->id)->get();
    }

    /**
     * Get the tag names given an array with the tag ids
     */

    public function getTagNames(array $tags): array
    {

        $tagsNames = [];
        foreach ($tags as $key => $value) {

            $tagInfo = CodeTag::find($value);
            $tagsNames[] = $tagInfo->name;
        }
        return $tagsNames;
    }

    /**
     * Stats 
     */
    public function totalEntries(): int
    {
        return CodeEntry::get()->count();
    }
    public function totalTypes(): int
    {
        return CodeType::get()->count();
    }
    public function totalCategories(): int
    {
        return CodeCategory::get()->count();
    }
    public function totalTags(): int
    {
        return CodeTag::get()->count();
    }
}
