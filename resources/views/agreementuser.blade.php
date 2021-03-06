@extends('components/layout')

@section('content')
    <main>
        <div class="container documentsAgreement">
            <div class="title">Пользовательское соглашение</div>
            <ol>
                <li> Общие положения
                    <ol>
                        <li>Настоящее Пользовательское соглашение (далее – Соглашение) относится к сайту «Крымский.ру», расположенному по адресу {{ route('main') }}.</li>
                        <li>Сайт «Крымский.ру» (далее – Сайт) является собственностью индивидуального предпринимателя Затеева Алексея Борисовича (ОГРН: 319784700157088, ИНН: 781616648200, адрес регистрации: 198320, г. Санкт-Петербург, г. Красное село, ул Освобождения, д.31, корп.4, кв.17 )</li>
                        <li>Настоящее Соглашение регулирует отношения между Администрацией сайта «Крымский.ру» (далее – Администрация сайта) и Пользователем данного Сайта.</li>
                        <li>Администрация сайта оставляет за собой право в любое время изменять, добавлять или удалять пункты настоящего Соглашения без уведомления Пользователя.</li>
                        <li>Использование Сайта Пользователем означает принятие Соглашения и изменений, внесенных в настоящее Соглашение.</li>
                        <li>Пользователь несет персональную ответственность за проверку настоящего Соглашения на наличие изменений в нем.</li>
                    </ol>
                </li>
                <li>
                    Определение терминов
                    <ol>
                        <li>Перечисленные ниже термины имеют для целей настоящего Соглашения следующее значение:
                            <ol>
                                <li>«Крымский.ру» – Интернет-ресурс, расположенный на доменном имени {{ route('main') }}, осуществляющий свою деятельность посредством Интернет-ресурса и сопутствующих ему сервисов (далее - Сайт).</li>
                                <li>«Крымский.ру» – сайт, содержащий информацию о Товарах и/или Услугах и/или Иных ценностях для пользователя, Продавце и/или Исполнителе услуг, позволяющий осуществить выбор, заказ и (или) приобретение Товара, и/или получение услуги.</li>
                                <li>Администрация сайта – уполномоченные сотрудники на управления Сайтом, действующие от имени юридического лица ИП Затеев Алексей Борисович.</li>
                                <li>Пользователь сайта (далее - Пользователь) – лицо, имеющее доступ к Сайту, посредством сети Интернет и использующее Сайт.</li>
                                <li>Содержание сайта (далее – Содержание) - охраняемые результаты интеллектуальной деятельности, включая тексты литературных произведений, их названия, предисловия, аннотации, статьи, иллюстрации, обложки, музыкальные произведения с текстом или без текста, графические, текстовые, фотографические, производные, составные и иные произведения, пользовательские интерфейсы, визуальные интерфейсы, названия товарных знаков, логотипы, программы для ЭВМ, базы данных, а также дизайн, структура, выбор, координация, внешний вид, общий стиль и расположение данного Содержания, входящего в состав Сайта и другие объекты интеллектуальной собственности все вместе и/или по отдельности, содержащиеся на сайте {{ route('main') }}.</li>
                            </ol>
                        </li>
                    </ol>
                </li>
                <li>
                    Предмет соглашения
                    <ol>
                        <li>
                            Предметом настоящего Соглашения является предоставление Пользователю доступа к содержащимся на Сайте Товарам и/или оказываемым услугам.
                            <ol>
                                <li> Сайт предоставляет Пользователю следующие виды услуг (сервисов): 
                                    <ul>
                                        <li>предоставление Пользователю возможности размещения сообщений, комментариев, рецензий Пользователей, выставления оценок контенту сайта;</li>
                                        <li>ознакомление с товарами/услугами, размещенными на Сайте;</li>
                                        <li>выбор и заказ товаров/услуг для осуществления последующей покупки или оформления на данном Сайте.</li>
                                    </ul>
                                </li>
                                <li>Под действие настоящего Соглашения подпадают все существующие (реально функционирующие) на данный момент услуги (сервисы) Сайта, а также любые их последующие модификации и появляющиеся в дальнейшем дополнительные услуги (сервисы).</li>
                            </ol>
                        </li>
                        <li>Доступ к сайту предоставляется на бесплатной основе.</li>
                        <li>Настоящее Соглашение является публичной офертой. Получая доступ к Сайту Пользователь считается присоединившимся к настоящему Соглашению.</li>
                        <li>Использование материалов и сервисов Сайта регулируется нормами действующего законодательства Российской Федерации</li>
                    </ol>
                </li>

                <li>
                    Услуги, предоставляемые сайтом для пользователей
                    <ol>
                        <li>
                            Сайт предоставляет возможность пользователю бесплатно размещать объявления о своих продуктах или услугах.
                        </li>
                        <li>
                            Сайт предоставляет возможность платного приоритетного размещения объявления, стоимостью от 20 рублей до 130 рублей в зависимости от категории объявления и сроком от 5 до 10 дней.
                        </li>
                    </ol>
                </li>

                <li>
                    Права и обязанности сторон
                    <ol>
                        <li>
                            Администрация сайта вправе:
                            <ol>
                                <li>Изменять правила пользования Сайтом, а также изменять содержание данного Сайта. Изменения вступают в силу с момента публикации новой редакции Соглашения на Сайте.</li>
                            </ol>
                        </li>
                        <li>Пользователь вправе:
                            <ol>
                                <li> Пользоваться всеми имеющимися на Сайте услугами, а также приобретать любые Товары и/или Услуги, предлагаемые на Сайте.</li>
                                <li>Задавать любые вопросы, относящиеся к услугам сайта:
                                    <ul>
                                        <li>по телефону: +7 (911) 848-69-55</li>
                                        <li>по электронной почте: krim.website@gmail.com</li>
                                        <li>через Форму обратной связи, расположенную по адресу: {{ route('main') }}</li>
                                    </ul>
                                </li>
                                <li>Пользоваться Сайтом исключительно в целях и порядке, предусмотренных Соглашением и не запрещенных законодательством Российской Федерации.</li>
                                <li>Требовать от администрации скрытия любой информации о пользователе.</li>
                                <li>Использовать информацию сайта в коммерческих целях без специального разрешения.</li>
                            </ol>
                        </li>
                        <li>Пользователь Сайта обязуется:
                            <ol>
                                <li>Предоставлять по запросу Администрации сайта дополнительную информацию, которая имеет непосредственное отношение к предоставляемым услугам данного Сайта.</li>
                                <li>Соблюдать имущественные и неимущественные права авторов и иных правообладателей при использовании Сайта.</li>
                                <li>Не предпринимать действий, которые могут рассматриваться как нарушающие нормальную работу Сайта.</li>
                                <li>Не распространять с использованием Сайта любую конфиденциальную и охраняемую законодательством Российской Федерации информацию о физических либо юридических лицах.</li>
                                <li>Избегать любых действий, в результате которых может быть нарушена конфиденциальность охраняемой законодательством Российской Федерации информации.</li>
                                <li>Не использовать Сайт для распространения информации рекламного характера, иначе как с согласия Администрации сайта.</li>
                                <li>Не использовать сервисы с целью:
                                    <ol>
                                        <li>нарушения прав несовершеннолетних лиц и (или) причинение им вреда в любой форме.</li>
                                        <li>ущемления прав меньшинств.</li>
                                        <li>представления себя за другого человека или представителя организации и (или) сообщества без достаточных на то прав, в том числе за сотрудников данного сайта.</li>
                                        <li>введения в заблуждение относительно свойств и характеристик какого-либо Товара и/или услуги, размещенных на Сайте.</li>
                                        <li>некорректного сравнения Товара и/или Услуги, а также формирования негативного отношения к лицам, (не) пользующимся определенными Товарами и/или услугами, или осуждения таких лиц.</li>
                                        <li>загрузки контента, который является незаконным, нарушает любые права третьих лиц; пропагандирует насилие, жестокость, ненависть и (или) дискриминацию по расовому, национальному, половому, религиозному, социальному признакам; содержит недостоверные сведения и (или) оскорбления в адрес конкретных лиц, организаций, органов власти.</li>
                                        <li>побуждения к совершению противоправных действий, а также содействия лицам, действия которых направлены на нарушение ограничений и запретов, действующих на территории Российской Федерации.</li>
                                    </ol>
                                </li>
                                <li>Обеспечить достоверность предоставляемой информации</li>
                                <li>Обеспечивать сохранность личных данных от доступа третьих лиц.</li>
                            </ol>
                        </li>
                        <li>Пользователю запрещается:
                            <ol>
                                <li>Использовать любые устройства, программы, процедуры, алгоритмы и методы, автоматические устройства или эквивалентные ручные процессы для доступа, приобретения, копирования или отслеживания содержания Сайта.</li>
                                <li>Нарушать надлежащее функционирование Сайта.</li>
                                <li>Любым способом обходить навигационную структуру Сайта для получения или попытки получения любой информации, документов или материалов любыми средствами, которые специально не представлены сервисами данного Сайта.</li>
                                <li>Несанкционированный доступ к функциям Сайта, любым другим системам или сетям, относящимся к данному Сайту, а также к любым услугам, предлагаемым на Сайте.</li>
                                <li>Нарушать систему безопасности или аутентификации на Сайте или в любой сети, относящейся к Сайту.</li>
                                <li>Выполнять обратный поиск, отслеживать или пытаться отслеживать любую информацию о любом другом Пользователе Сайта.</li>
                                <li>Использовать Сайт и его Содержание в любых целях, запрещенных законодательством Российской Федерации, а также подстрекать к любой незаконной деятельности или другой деятельности, нарушающей права Сайта или других лиц.</li>
                            </ol>
                        </li>
                    </ol>
                </li>
                <li>Использование сайта
                    <ol>
                        <li>Сайт и Содержание, входящее в состав Сайта, принадлежит и управляется Администрацией сайта.</li>
                        <li>Содержание Сайта защищено авторским правом, законодательством о товарных знаках, а также другими правами, связанными с интеллектуальной собственностью, и законодательством о недобросовестной конкуренции.</li>
                        <li>Настоящее Соглашение распространяет свое действия на все дополнительные положения и условия о покупке Товара и/или оказанию услуг, предоставляемых на Сайте.</li>
                        <li>Информация, размещаемая на Сайте не должна истолковываться как изменение настоящего Соглашения.</li>
                        <li>Администрация сайта имеет право в любое время без уведомления Пользователя вносить изменения в перечень Товаров и услуг, предлагаемых на Сайте, и (или) их цен.</li>
                        <li>Документ указанный в пункте 5.7. настоящего Соглашения регулирует в соответствующей части и распространяют свое действие на использование Пользователем Сайта.</li>
                        <li>Политика конфиденциальности: <a href="{{ route('agreement.privacyPolicy') }}">{{ route('agreement.privacyPolicy') }}</a></li>
                        <li>Любой из документов, перечисленных в пункте 5.7 настоящего Соглашения может подлежать
                            обновлению. Изменения вступают в силу с момента их опубликования на Сайте.
                        </li>
                    </ol>
                </li>
                <li>Ответственность
                    <ol>
                        <li>Любые убытки, которые Пользователь может понести в случае умышленного или неосторожного нарушения любого положения настоящего Соглашения, а также вследствие несанкционированного доступа к коммуникациям другого Пользователя, Администрацией сайта не возмещаются.</li>
                        <li>Администрация сайта не несет ответственности за: 
                            <ol>
                                <li>Задержки или сбои в процессе совершения операции, возникшие вследствие непреодолимой силы, а также любого случая неполадок в телекоммуникационных, компьютерных, электрических и иных смежных системах.</li>
                                <li>Действия систем переводов, банков, платежных систем и за задержки связанные с их работой.</li>
                                <li>Надлежащее функционирование Сайта, в случае, если Пользователь не имеет необходимых технических средств для его использования, а также не несет никаких обязательств по обеспечению пользователей такими средствами.</li>
                            </ol>
                        </li>
                    </ol>
                </li>
                <li>
                Нарушение условий пользовательского соглашения
                    <ol>
                        <li>Администрация сайта имеет право раскрыть информацию о Пользователе, если действующее законодательство Российской Федерации требует или разрешает такое раскрытие.</li>
                        <li>Администрация сайта вправе без предварительного уведомления Пользователя прекратить и (или) заблокировать доступ к Сайту, если Пользователь нарушил настоящее Соглашение или содержащиеся в иных документах условия пользования Сайтом, а также в случае прекращения действия Сайта либо по причине технической неполадки или проблемы.</li>
                        <li>Администрация сайта не несет ответственности перед Пользователем или третьими лицами за прекращение доступа к Сайту в случае нарушения Пользователем любого положения настоящего Соглашения или иного документа, содержащего условия пользования Сайтом.</li>
                    </ol>
                </li>
                <li> 
                    Разрешение споров
                    <ol>
                        <li>В случае возникновения любых разногласий или споров между Сторонами настоящего Соглашения обязательным условием до обращения в суд является предъявление претензии (письменного предложения о добровольном урегулировании спора).</li>
                        <li>Получатель претензии в течение 30 календарных дней со дня ее получения, письменно уведомляет заявителя претензии о результатах рассмотрения претензии.</li>
                        <li>При невозможности разрешить спор в добровольном порядке любая из Сторон вправе обратиться в суд за защитой своих прав, которые предоставлены им действующим законодательством Российской Федерации.</li>
                        <li>Любой иск в отношении условий использования Сайта должен быть предъявлен в течение 5 дней после возникновения оснований для иска, за исключением защиты авторских прав на охраняемые в соответствии с законодательством материалы Сайта. При нарушении условий данного пункта любой иск оставляется судом без рассмотрения.</li>
                    </ol>
                </li>
                <li>
                    Дополнительные условия
                    <ol>
                        <li>Администрация сайта не принимает встречные предложения от Пользователя относительно изменений настоящего Пользовательского соглашения.</li>
                        <li>Отзывы Пользователя, размещенные на Сайте, не являются конфиденциальной информацией и могут быть использованы Администрацией сайта без ограничений.</li>
                    </ol>
                </li>
            </ol>
        </div>
    </main>
@endsection