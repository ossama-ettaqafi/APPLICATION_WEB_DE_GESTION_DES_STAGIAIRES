<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Exports\InternsExport;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelType;

use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Response;

class InternController extends Controller
{
    public function showAddInternForm()
    {
        $interns = Intern::all(); // Retrieve all interns
    
        return view('pages.dashboard.add-intern', ['interns' => $interns]);
    }  

    public function showInterns()
    {
        $interns = Intern::all();
    
        return view('pages.dashboard.edit-intern', ['interns' => $interns]);
    }    

    public function showInternsForDelete()
    {
        $interns = Intern::all();

        return view('pages.dashboard.delete-intern', ['interns' => $interns]);
    }

    public function showInternDetailsMain()
    {
        // Count all interns
        $internCount = Intern::count();
    
        // Count distinct sectors
        $sectorsCount = Intern::distinct('sector')->count('sector');
    
        // Count interns near completion based on the current date
        $currentDate = Carbon::now();
        $nearCompletionCount = Intern::whereNotNull('endDate')
            ->whereDate('endDate', '>=', $currentDate)
            ->count();
    
        // Retrieve all interns
        $interns = Intern::all();
    
        return view('pages.dashboard.main', [
            'internCount' => $internCount,
            'sectorsCount' => $sectorsCount,
            'nearCompletionCount' => $nearCompletionCount,
            'interns' => $interns,
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required',
            'school' => 'required',
            'sector' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048|dimensions:min_width=256,min_height=256',
            'cin' => 'required',
        ], [
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom de famille est requis.',
            'age.required' => 'L\'âge est requis.',
            'age.numeric' => 'L\'âge doit être un nombre.',
            'address.required' => 'L\'adresse est requise.',
            'phone.required' => 'Le téléphone est requis.',
            'school.required' => 'L\'école est requise.',
            'sector.required' => 'Le secteur est requis.',
            'startDate.required' => 'La date de début est requise.',
            'startDate.date' => 'La date de début doit être une date valide.',
            'endDate.required' => 'La date de fin est requise.',
            'endDate.date' => 'La date de fin doit être une date valide.',
            'image.image' => 'Le fichier doit être une image valide (JPEG, PNG).',
            'image.mimes' => 'Le fichier doit être de type JPEG ou PNG.',
            'image.max' => 'La taille de l\'image ne doit pas dépasser 2 Mo.',
            'image.dimensions' => 'L\'image doit avoir une largeur minimale de 256 pixels et une hauteur minimale de 256 pixels.',
            'cin.required' => 'Le CIN est requis.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $intern = Intern::findOrFail($id);
        $intern->fill($request->except('image'));
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($intern->image !== "/images/intern.png") {
                // If the current image is not the default image,
                // delete the old image from storage
                Storage::delete($intern->image);
            }
        
            $imagePath = $image->store('public/images/interns');
            $imagePath = 'storage' . substr($imagePath, 6);
            $intern->image = $imagePath;
        }
        
        $intern->save();

        return redirect()->back()->with('success', 'Stagiaire modifié avec succès !');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required',
            'school' => 'required',
            'sector' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048|dimensions:min_width=256,min_height=256',
            'cin' => 'required',
        ], [
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom de famille est requis.',
            'age.required' => 'L\'âge est requis.',
            'age.numeric' => 'L\'âge doit être un nombre.',
            'address.required' => 'L\'adresse est requise.',
            'phone.required' => 'Le téléphone est requis.',
            'school.required' => 'L\'école est requise.',
            'sector.required' => 'Le secteur est requis.',
            'startDate.required' => 'La date de début est requise.',
            'startDate.date' => 'La date de début doit être une date valide.',
            'endDate.required' => 'La date de fin est requise.',
            'endDate.date' => 'La date de fin doit être une date valide.',
            'image.image' => 'Le fichier doit être une image valide (JPEG, PNG).',
            'image.mimes' => 'Le fichier doit être de type JPEG ou PNG.',
            'image.max' => 'La taille de l\'image ne doit pas dépasser 2 Mo.',
            'image.dimensions' => 'L\'image doit avoir une largeur minimale de 256 pixels et une hauteur minimale de 256 pixels.',
            'cin.required' => 'Le CIN est requis.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $intern = new Intern($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($intern->image !== "/images/intern.png") {
                // If the current image is not the default image,
                // delete the old image from storage
                Storage::delete($intern->image);
            }

            $imagePath = $image->store('public/images/interns');
            $imagePath = 'storage' . substr($imagePath, 6);
            $intern->image = $imagePath;
        } else {
            // If no image is uploaded, set the default image path
            $intern->image = "/images/intern.png";
        }

        $intern->save();

        return redirect()->back()->with('success', 'Stagiaire créé avec succès !');
    }

    public function deleteSelected(Request $request)
    {
        $internIds = $request->input('intern_ids');
    
        if (!empty($internIds)) {
            $interns = Intern::whereIn('id', $internIds)->get();
    
            foreach ($interns as $intern) {
                // Delete the intern's image file
                if ($intern->image !== '/images/intern.png') {
                    $imagePath = public_path($intern->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
    
            // Delete the selected interns from the database
            Intern::whereIn('id', $internIds)->delete();
        }
    
        return redirect()->back()->with('success', 'Selected interns have been deleted.');
    }    

    public function fastAdd(Request $request)
    {
        // Create a new Intern instance
        $intern = new Intern();
        $intern->firstName = $request->input('new-firstname');
        $intern->lastName = $request->input('new-lastname');
        $intern->age = $request->input('new-age');
        $intern->cin = $request->input('new-cin');
        $intern->phone = $request->input('new-phone');
        $intern->address = $request->input('new-address');
        $intern->school = $request->input('new-school');
        $intern->sector = $request->input('new-sector');
        $intern->startDate = $request->input('new-startdate');
        $intern->endDate = $request->input('new-enddate');
        $intern->image = '/images/intern.png'; // Set the image path

        // Save the intern in the database
        $intern->save();

        // Redirect or perform any other action after saving the intern

        // Example: Redirect to the dashboard page
        return redirect()->back()->with('success', 'Intern added successfully!');
    }

    public function fastEdit(Request $request, $id)
    {
        // Find the intern by ID
        $intern = Intern::find($id);
        if (!$intern) {
            // Handle if intern not found
            return redirect()->back()->with('error', 'Intern not found');
        }
    
        // Update the intern's fields
        $intern->firstName = $request->input('edit-firstname');
        $intern->lastName = $request->input('edit-lastname');
        $intern->age = $request->input('edit-age');
        $intern->cin = $request->input('edit-cin');
        $intern->phone = $request->input('edit-phone');
        $intern->address = $request->input('edit-address');
        $intern->school = $request->input('edit-school');
        $intern->sector = $request->input('edit-sector');
        $intern->startDate = $request->input('edit-startdate');
        $intern->endDate = $request->input('edit-enddate');
    
        // Save the updated intern
        $intern->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Intern updated successfully');
    }
    
    public function destroy($id)
    {
        $intern = Intern::findOrFail($id);
        $intern->delete();

        return redirect()->back()->with('success', 'Intern deleted successfully');
    }

    public function exportToPDF(Request $request)
    {
        $data = Intern::all();
        $perPage = 20;
        $totalPages = ceil($data->count() / $perPage);
    
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
    
        $dompdf = new Dompdf($pdfOptions);
    
        $pageNumber = 1;
        $view = View::make('interns.export_pdf', compact('data', 'pageNumber', 'totalPages'))->render();
        $dompdf->loadHtml($view);
        $dompdf->render();
    
        $output = $dompdf->output();
    
        $pdfFile = 'interns_' . now()->format('Ymd_His') . '.pdf';
        file_put_contents($pdfFile, $output);
    
        for ($pageNumber = 2; $pageNumber <= $totalPages; $pageNumber++) {
            $view = View::make('interns.export_pdf', compact('data', 'pageNumber', 'totalPages'))->render();
            $dompdf->loadHtml($view);
            $dompdf->render();
    
            $output = $dompdf->output();
    
            file_put_contents($pdfFile, $output, FILE_APPEND);
        }
    
        return response()->download($pdfFile)->deleteFileAfterSend();
    }
    
    public function exportToExcel()
    {
        $fileName = 'interns_' . Date::now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new InternsExport, $fileName, ExcelType::XLSX);
    } 
    
    public function generateAttestation($id)
    {
        // Retrieve the intern data based on the provided ID
        $intern = Intern::find($id);
    
        // Perform any necessary data manipulation or processing here
    
        // Pass the intern data to the attestation view
        $data = [
            'intern' => $intern,
            // Include any other necessary data for the attestation view
        ];
    
        // Render the attestation view as HTML
        $html = view('interns.attestation', $data)->render();
    
        // Generate the PDF using dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Get the PDF content
        $pdfContent = $dompdf->output();
    
        // Encode the PDF content as base64
        $base64PdfContent = base64_encode($pdfContent);
    
        // Generate JavaScript code to display a modal popup with the PDF and trigger print
        $jsCode = <<<JS
    <script>
        var pdfContainer = document.createElement('div');
        pdfContainer.innerHTML = '<iframe id="pdfFrame" src="data:application/pdf;base64,{$base64PdfContent}" style="width:100%; height:100%;" frameborder="0"></iframe>';
        
        var printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.write('<html><head><title>Attestation</title><style>body, html { margin: 0; padding: 0; }</style></head><body></body></html>');
        printWindow.document.body.appendChild(pdfContainer);
        printWindow.document.getElementById('pdfFrame').contentWindow.print();
        printWindow.document.close();

        // Close the current page
        window.close();
    </script>
    JS;
    
        // Return the JavaScript code
        return $jsCode;
    }
    

}
