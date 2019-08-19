@extends('layouts.header')

@section('title')
    Support
@endsection

@section('content')
        <div class="bg-header">
            <h1 class="text-4xl text-white ">Welcome to your ClickerHero player support !</h1>
        </div>
        <div class="bg-base">
            <h2 class="text-4xl subtitle">Let us know, how we can help you out</h2>
            <div class="flex globalW p-3 mx-auto">
                <div class="w-2/3 waller mr-3">
                    <form method="POST" action="" class="">
                        @csrf
                        <div class="flex flex-wrap mb-2">
                            <label class="block tracking-wide xl:w-full" for="topic">Choose your topic</label>
                            <select id="topic" class="block tshadow appearance-none w-full bg-gray-200 border border-gray-200
                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                focus:border-gray-500 text-xl mb-5 xl:w-1/2">

                                <option value="emptyTopic" selected> ----- </option>
                                <option value="acc">Account & Login</option>
                                <option value="pay">Payment</option>
                                <option value="bug">Bug-report</option>
                                <option value="report">Report a player</option>
                                <option value="other">Other topic</option>

                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                                </div>
                            </select>
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="title">Title</label>
                            <input class="tshadow placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full xl:w-1/2 p-2 mb-2" type="text" id="title" placeholder="Type in your title .." required>
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="description">Description</label>
                            <textarea class="tshadow placeholder-gray-600 focus:placeholder-transparent shadow-none input w-full mb-2 xl:w-1/2 p-2" rows="5" id="description" placeholder="Describe your issue .."></textarea>
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="other">Other information / Screenshot-links</label>
                            <input class="tshadow placeholder-gray-600 focus:placeholder-transparent appearance-none border rounded w-full xl:w-1/2 p-2 mb-5" type="text" id="other" placeholder="Further information .." required>
                        </div>

                        <div class="">
                            <label class="block tracking-wide xl:w-full" for="region">Choose your region</label>
                            <select id="region" class="block tshadow text-gray-700 appearance-none w-full bg-gray-200 border border-gray-200
                                     py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white
                                    focus:border-gray-500 text-xl xl:w-1/2 mb-6">

                                <option value="emptyRegion" selected> ----- </option>
                                <option value="na">North America</option>
                                <option value="eu">Europe</option>
                                <option value="ca">Central Asia</option>
                                <option value="oc">Oceania</option>
                                <option value="sa">South America</option>
                            </select>
                        </div>


                        <div class="flex justify-center xl:justify-start my-5">
                            <button type="submit" class="borderDesign bg-orange-400 hover:bg-orange-700 text-white
                                text-2xl font-bold py-0.5 px-4 rounded">Submit your ticket</button>
                        </div>
                    </form>
                </div>
                <div class="w-1/3 py-3  mx-auto">
                    <div class="faq">
                        <h2 class="text-xl -ml-4 underline pb-5">FAQ</h2>
                        <ul>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">How do I recover my password? </a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Will I lose my progress if I close the game without saving?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Is there a mobile app?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">How does ascending work?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">When is the next update?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Any tips on what I should do/buy next?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Is [ ... ] considered cheating?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Beginner: What do I have to know?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Why is the support replying with 42?</a></li>
                            <li class="mb-2"><a class="underline hover:text-white" href="/support">Who is John Doe?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center filler">
            <a class="px-5 hover:underline" href="/">Startpage</a>
            <a class="px-5 hover:underline" href="/support">Impressum</a>
            <a class="px-5 hover:underline" href="/support">Inhalt</a>
            <a class="px-5 hover:underline" href="/support">Datenschutz</a>
            <a class="px-5 hover:underline" href="/game">Back to Game</a>
        </div>
@endsection
