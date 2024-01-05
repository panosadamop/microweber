<?php
namespace MicroweberPackages\Multilanguage\View\Components\FormElements;

use Illuminate\View\Component;

class InputText extends Component
{

    public $randId;
    public $defaultLanguage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $this->defaultLanguage = mw()->lang_helper->default_lang();
        $this->currentLanguage = mw()->lang_helper->current_lang();

        $this->randId = 'ml_editor_element_'.md5(str_random());

        $fieldName = 'input_element_name';
        $fieldValue = '';

        $locales = [];
        $supportedLanguages = get_supported_languages(true);
        foreach ($supportedLanguages as $language) {
            $locales[] = $language['locale'];
        }

        $translations = [];
        // Fill with empty values
        foreach ($locales as $locale) {
            $translations[$locale] = '';
        }

        $currentLanguageData = [];
        foreach ($supportedLanguages as $language) {
            if ($language['locale'] == $this->currentLanguage) {
                $currentLanguageData = $language;
            }
        }

        return view('multilanguage::components.form-elements.input-text', [
            'randId' => $this->randId,
            'fieldName' => $fieldName,
            'fieldValue' => $fieldValue,
            'defaultLanguage' => $this->defaultLanguage,
            'supportedLanguages' => $supportedLanguages,
            'currentLanguageData' => $currentLanguageData,
            'translations' => $translations,
        ]);
    }
}