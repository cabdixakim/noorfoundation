<template>
  <nav class="bg-gray-600">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button @click="menuOpen = !menuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out" aria-label="Main menu" aria-expanded="false">
          <!-- Icon when menu is closed. -->
          <svg :class="menuOpen ? 'hidden' : 'block'" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <!-- Icon when menu is open. -->
          <svg :class="menuOpen ? 'block' : 'hidden'" class=" h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0">
          <!-- put logo in here -->
          <img class="h-6 w-6" :src="logo" alt="">
        </div>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex">
            <a :href="this.showProfile" class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Dashboard
            </a>
            
            <a :href="this.sponsorsRoute" v-if="user.user_type == 'sponsor'" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Sponsors
            </a>
            <a :href="this.studentsRoute" v-if="user.user_type == 'sponsor'" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Current students
            </a>
            <a :href="this.graduatedRoute" v-if="user.user_type == 'sponsor'" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Graduated students
            </a>
             <a v-if="user.user_type == 'sponsor'" :href="this.depositsRoute" class="mt-1 sm:ml-3 block px-3  rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
               <i class="fa  fa-plus-circle text-green-400"></i>
               deposits
             </a>
             <a v-if="user.user_type == 'sponsor'" :href="this.withdrawalsRoute" class="mt-1 sm:ml-2 block px-3 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
               <i class="fa fa-minus-circle text-red-400 "></i>
               withdrawals
            </a>
            <a v-if="user.user_type == 'sponsor'" :href="this.paymentRoute" class="ml-32 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">Donate Now
            </a>
            <a v-if="user.user_type == 'student'" :href="this.transcriptRoute" class="sm:ml-20 px-4 pt-2  rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">Submit Results
            </a>
            <a v-if="user.user_type == 'student'" :href="this.receiptRoute" class="sm:ml-8 px-4 pt-2  rounded-full text-sm font-medium  leading-5 text-gray-300 hover:text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">
              <i class="fa  fa-plus-circle text-green-400"></i>
              Add receipt
            </a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button type="reset" @click="notifyclick" class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out" aria-label="Notifications">
         <div v-if="notification != 0 && user.user_type == 'sponsor'" class=" p-1 absolute inset-y-0 ml-3 sm:inset-y-2 sm:ml-4 sm:mt-2"> <span class=" text-red-400 font-bold ">{{notification}}</span></div>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </button>

        <!-- Profile dropdown -->
        <div class="ml-3 relative">
          <div>
            <button @click="profileOpen = !profileOpen, menuOpen = false" class="relative flex z-10 text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out" id="user-menu" aria-label="User menu" aria-haspopup="true">
              <img class="h-8 w-8 rounded-full" :src="this.avatar" alt="" />
            </button>
            <!-- a button that covers all screen to enable menu click away -->
            <button v-if="profileOpen" @click="profileOpen = false" tabindex="-1" class=" fixed w-full h-full inset-0 bg-black opacity-25"></button>
          </div>
          <!--
            Profile dropdown panel, show/hide based on dropdown state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
          <div :class="profileOpen ? 'block' : 'hidden'" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg z-10">
            <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
              <a :href="this.createProfileRoute" v-if="user.user_type != 'admin'" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Your Profile
              </a>
              <a v-if="user.user_type == 'student'" :href="this.createPlanRoute" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">plan
              </a>
              <a  href="/easy-password-reset/create" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Reset Password
              </a>
              <a :href="this.logoutRoute" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" role="menuitem">Sign out
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--
    Mobile menu, toggle classes based on menu state.

    Menu open: "block", Menu closed: "hidden"
  -->
  <div :class="menuOpen ? 'block' : 'hidden'" class="sm:hidden ">
    <div class="px-2 pt-2 pb-3 " >
      <a :href="this.showProfile" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Dashboard
      </a>
      <a :href="this.paymentRoute" v-if="user.user_type == 'sponsor'" class="mt-2 sm:mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 bg-green-400  hover:text-white  hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">Donate Now
      </a>
      <a :href="this.transcriptRoute" v-if="user.user_type == 'student'" class="mt-2 sm:mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 bg-green-400 hover:text-white hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">Sumbit Results
      </a>
      <a v-if="user.user_type == 'student'" :href="this.receiptRoute" class="sm:ml-8 px-4 block pt-2 mt-2 sm:mt-1 rounded-full text-sm font-medium  leading-5 text-gray-300 hover:text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">
              <i class="fa  fa-plus-circle text-green-400"></i>
              Add receipt
      </a>
      <a :href="this.sponsorsRoute" v-if="user.user_type == 'sponsor'" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Sponsors
      </a>
      <a :href="this.studentsRoute" v-if="user.user_type == 'sponsor'" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">current students
      </a>
      <a :href="this.graduatedRoute" v-if="user.user_type == 'sponsor'" class="mt-1 block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Graduated students
      </a>
      <a v-if="user.user_type == 'sponsor'" :href="this.depositsRoute" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">deposits
      </a>
      
      <a v-if="user.user_type == 'sponsor'" :href="this.withdrawalsRoute" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">withdrawals
      </a>
    </div>
  </div>
    <!-- a button that covers all screen to enable menu click away -->
  <!-- <button v-if="menuOpen" @click="menuOpen = false" tabindex="-1"  class="fixed w-full h-full inset-0 bg-black opacity-25"></button> -->
</nav>
</template>

<script>
    export default {
       data: function() {
            return {
                menuOpen: false,
                profileOpen: false
            }
        },

        props: [
           'user',
           'createPlanRoute',
           'createProfileRoute',
           'showProfile',
           'logoutRoute',
           'avatar',
           'logo',
           'paymentRoute',
           'studentsRoute',
           'graduatedRoute',
           'paymentlistRoute',
           'transcriptRoute',
           'receiptRoute',
           'sponsorsRoute',
           'notification',
           'notificatonRoute',
           'depositsRoute',
           'withdrawalsRoute'
        ],
        
        methods: {
            toggleMenu() {
                this.isOpen = !this.isOpen
            },
            notifyclick(){
              this.open = false;
              if (this.user.user_type != 'student') {
                
                window.location.href = window.location.origin +'/notifications';
              }
              
            }
        }
    }
</script>
