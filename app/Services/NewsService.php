<?php

namespace App\Services;

use App\Repositories\NewsRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use InvalidArgumentException;



class NewsService
{
    /**
     * @var
     */
    protected $newsRepository;

    /**
     * NewsService constructor.
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Delete news by id.
     *
     * @param $id
     *
     * @return string
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $del = $this->newsRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete news data');
        }

        DB::commit();

        return $del;
    }

    /**
     * Get all news.
     *
     * @return string
     */
    public function getAll()
    {
        return $this->newsRepository->getAll();
    }

    /**
     * Get all published news.
     *
     * @return string
     */
    public function getAllPublished()
    {
        return $this->newsRepository->getAllPublished();
    }


    /**
     * Get news by id.
     *
     * @param $id
     *
     * @return string
     */
    public function getById($id)
    {
        return $this->newsRepository->getById($id);
    }

    /**
     * Get published news by id.
     *
     * @param $id
     *
     * @return string
     */
    public function getPublishedById($id)
    {
        return $this->newsRepository->getPublishedById($id);
    }

    /**
     * Get all news by dates.
     *
     * @param array $dates
     *
     * @return string
     */
    public function getAllByDates($dates)
    {
        return $this->newsRepository->getAllByDates($dates);
    }


    /**
     * Update news data
     * Store to DB if there are no errors.
     *
     * @param array $data
     *
     * @return string
     */
    public function updateNews($data, $id)
    {
        if (Arr::hasAny($data, ['title', 'authorName'])) {
            $validator = Validator::make($data, [
                'title' => 'required|max:255',
                'authorName' => 'required|max:255',
                'content' => 'required',
                'publishedAt' => 'sometimes|date_format:Y-m-d H:i:s',
            ]);

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }
        }

        DB::beginTransaction();

        try {
            $update = $this->newsRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update news data');
        }

        DB::commit();

        return $update;
    }

    /**
     * Validate news data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     *
     * @return string
     */
    public function savePostData($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'authorName' => 'required|max:255',
            'content' => 'required',
            'publishedAt' => 'sometimes|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->newsRepository->save($data);

        return $result;
    }
}
