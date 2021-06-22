<?php

namespace App\Repositories;

use App\Models\News;
use DateTime;

class NewsRepository
{
    /**
     * @var News
     */
    protected $news;

    /**
     * PostRepository constructor.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Get all news.
     *
     * @return News $news
     */
    public function getAll()
    {
        return $this->news->get();
    }

    /**
     * Get all published news.
     *
     * @return News $news
     */
    public function getAllPublished()
    {
        return $this->news
            ->where('published_at', '<', date('Y-m-d H:i:s'))
            ->where('display', 1)
            ->orderBy('published_at', 'DESC')
            ->paginate(10);
    }


    /**
     * Get news by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        return $this->news
            ->where('id', $id)
            ->first();
    }

    /**
     * Get published news by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function getPublishedById($id)
    {
        return $this->news
            ->where('id', $id)
            ->where('published_at', '<', date('Y-m-d H:i:s'))
            ->where('display', 1)
            ->first();
    }

    /**
     * Get all news by dates.
     *
     * @param array $dates
     *
     * @return mixed
     */
    public function getAllByDates($dates)
    {
        if (($dates['before'] ?? null) !== null) {
            $time_end = (new DateTime($dates['before']))->format('Y-m-d H:i:s');
            $this->news = $this->news->whereRaw("published_at <= '".$time_end."'");
        }

        if (($dates['after'] ?? null) !== null) {
            $time_start = (new DateTime($dates['after']))->format('Y-m-d H:i:s');
            $this->news = $this->news->whereRaw("published_at >= '".$time_start."'");
        }

        return $this->news->get();
    }

    /**
     * Save News.
     *
     * @param $data
     *
     * @return News
     */
    public function save($data)
    {
        $news = new $this->news();

        $news->title = $data['title'];
        $news->author_name = $data['authorName'];
        $news->content = $data['content'];
        $news->published_at = $data['publishedAt'];
        $news->display = $data['display'] ?? 0;
        $news->save();
        return $news->fresh();
    }

    /**
     * Update News.
     *
     * @param $data
     *
     * @return News
     */
    public function update($data, $id)
    {
        $news = $this->news->find($id);

        if (isset($data['title'])) {
            $news->title = $data['title'];
        }
        if (isset($data['authorName'])) {
            $news->author_name = $data['authorName'];
        }
        if (isset($data['content'])) {
            $news->content = $data['content'];
        }
        if (isset($data['publishedAt'])) {
            $news->published_at = $data['publishedAt'];
        }
        $news->display = $data['display'] ?? 0;
        $news->update();

        return $news;
    }

    /**
     * Update News.
     *
     * @param $data
     *
     * @return News
     */
    public function delete($id)
    {
        $news = $this->news->find($id);
        $news->delete();

        return $news;
    }



}
