<?php

namespace App\Mail;

use App\Models\Main\Vacancy;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TagSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Подписчик
     * @var \App\Models\Subscriber
     */
    public $subscriber;

    /**
     * @var \App\Models\Main\Vacancy
     */
    public $vacancy;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber, Vacancy $vacancy)
    {
        $this->subscriber = $subscriber;
        $this->vacancy = $vacancy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('a.andreev@job-barnaul.ru', 'Работа.Барнаул')
            ->with([
                'name' => $this->subscriber->name,
                'email' => $this->subscriber->email,
                'tagTitle' => $this->subscriber->tag->title,
                'vacId' => $this->vacancy->id,
                'vacTitle' => $this->vacancy->title,
                'vacSalary' => $this->vacancy->min_salary,
                'vacExperience' => $this->vacancy->experience->title,
                'vacSchedule' => $this->vacancy->schedule->title,
                'vacEmployer' => $this->vacancy->employer,
                'vacAddress' => $this->vacancy->address,
            ])->subject($this->subscriber->name.', для вас новая вакансия!')
            ->view('emails.tag.subscribed');
    }
}
